$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadForm();
    $("#btn-loading").hide();
    $("#btn-submit").hide();
    // $("#btn-backNilai").hide();
});

function submitForm()
{
    /**Animasi */
    $("#btn-submit").hide();
    $("#btn-loading").show();

    var url = "/nilai";
    var mapel = $("#mapel").val();
    var kelas = $("#kelas-form").val();
    var semester = $("#semester").val();
    var tanggal_penilaian = $("#tanggal_penilaian").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            mapel:mapel,
            kelas:kelas,
            semester:semester,
            tanggal_penilaian:tanggal_penilaian,
        }, success:function(response){
            /**Animasi */
            $("#btn-loading").hide();
            $("#btn-submit").show();
            loadForm();
            cekButton();
            cekBtnSubmit()
            $("#btn-submit").attr('Disabled', true);
        }
    });
}

$("#mapel").change(function(){
    loadForm();
    cekButton();
    cekBtnSubmit()
});

$("#kelas-form").change(function(){
    loadForm();
    cekButton();
    cekBtnSubmit()
});

function cekButton()
{
    var kelas = $("#kelas-form").val();
    var mapel = $("#mapel").val();
    var url = "/nilai/" + kelas + "/" + mapel + "/ajax";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(response){
            if(response.count === 0){
                $("#btn-submit").show();
            }else{
                $("#btn-submit").hide();
            }
        }
    });
}

function loadForm()
{
    var kelas = $("#kelas-form").val();
    var mapel = $("#mapel").val();
    var url = "/nilai/" + kelas + "/" + mapel;
    $("#formNilai").load(url);
}

function lockScore(id)
{
    var namaInput = "#score-" + id;
    var nilai = $(namaInput).val();
    var namaBtn = "#btn-lock-" + id;
    var namaBtnUnlock = "#btn-unlock-" + id;
    var deskripsiForm = "#desc-" + id;
    var deskripsi = $(deskripsiForm).val();

    /**Animasi */
    $(namaBtn).html('<i class="bi bi-three-dots"></i>');

    $.ajax({
        url:'/nilai/update',
        type:'POST',
        cache:false,
        data:{
            idscore:id,
            nilai:nilai,
            deskripsi:deskripsi,
        },success:function(response){
            /**Animasi */
            $(namaBtn).html('<i class="bi bi-check2-square"></i>');
            $(namaBtn).attr('Disabled', true);
            $(namaInput).attr('Disabled', true);
            $(deskripsiForm).attr('disabled', true);
            $(namaBtnUnlock).attr('Disabled', false);
            $(namaBtnUnlock).html('<i class="bi bi-unlock"></i>');
            cekBtnSubmit()

        }
    });

}

function cekBtnSubmit()
{
    var mapel = $("#mapel").val();
    var kelas = $("#kelas-form").val();
    var url = "/nilai/" + kelas + "/" + mapel + "/cekBtnSubmit";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(response){

            $("#jumlah").html(response.jumlah);
            $("#final").html(response.final);
            $("#isi").html(response.isi);

            if(response.jumlah === response.isi){
                $("#btn-submitNilai").show();
                $("#btn-backNilai").hide();
            }
            if(response.final === response.isi){
                $("#btn-submitNilai").hide();
                $("#btn-backNilai").show();
            }
            if(response.jumlah !== response.final){
                $("#btn-submitNilai").show();
                $("#btn-backNilai").hide();
            }
        }
    });

}

function unlock(id)
{
    /**Animasi */
    var namaBtn = "#btn-unlock-" + id;
    var namaBtnLock = "#btn-lock-" + id;
    var namaForm = "#score-" + id;
    var deskripsiForm = "#desc-" + id;
    

    $(namaBtn).html('<i class="bi bi-three-dots"></i>');
    $(namaBtn).attr('Disabled', true);

    var url = "/nilai/unlock";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            $(namaBtnLock).attr('Disabled', false);
            $(namaBtn).attr('Disabled', true);
            $(namaForm).attr('Disabled', false);
            $(deskripsiForm).attr('disabled', false);
            $(namaBtn).html('<i class="bi bi-unlock-fill"></i>');
            cekBtnSubmit()
        },
        error:function(){
            $(namaBtn).attr('Disabled', false);
            console.log('unlocked failed');
        }
    });
}

function submitNilai()
{
    /**Animasi */
    $("#btn-submitNilai").attr('Disabled', true);
    $("#btn-submitNilai").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
    var mapel = $("#mapel").val();
    var kelas = $("#kelas-form").val();
    var url = "/nilai/tagFinal";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            mapel:mapel,
            kelas:kelas,
        },
        success:function(response){
            loadForm()
            console.log(response.success)
        },
        error:function(){
            loadForm()
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Terjadi Kesalahan!',
            });
        }
    });
}