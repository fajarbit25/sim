$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#progres-loading").hide();
    $("#btn-loading-report").hide();
    loadFormAbsen();

});

function loadFormAbsen()
{
    var url = "/absen/form";
    $("#formAbsen").load(url);
}

function cariSiswa()
{
    let key = $("#search").val()

    if(key==0){
        loadFormAbsen();
    }else{
        url = "/absen/" +  key + "/form";
        $("#formAbsen").load(url);
    } 
}

function modalAbsen(mapel, id)
{

    $("#button-addon2").attr('onclick', 'saveAbsen(' + id + ')')
    $("#mapel-absen").val(mapel)
    $("#modal-absen").modal('show');
}

function saveAbsen(id)
{
    $("#progres-loading").show();
    var url = "/absen/update";
    var absen = $("#absen").val();
    var mapel = $("#mapel-absen").val();
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            absen:absen,
            mapel:mapel
        },success:function(response){
            $("#progres-loading").hide();
            $("#modal-absen").modal('hide');
            loadFormAbsen();
        }
    });
}


/**Show Report Absensi */
function showAbsen(id)
{
    $('.btn-search').html('<i class="bi bi-search"></i>');
    $('.btn-search').attr('Disabled', false);

    var namaBtn = "#btn-cari-"+id;
    $(namaBtn).html('<i class="bi bi-arrow-right"></i>');
    $(namaBtn).attr('Disabled', true);

    var kelas = $("#kelas").val();
    var tanggal = $("#tanggal").val();
    var campus = $("#campus").val();
    var url = "/absen/" + kelas + "/" + id + "/" + tanggal + "/" + campus + "/show";

    $("#tableReport").load(url);
}

$("#btn-submit-report").click(function(){

    var kelas = $("#kelas").val();
    var tanggal = $("#tanggal").val();
    var campus = $("#campus").val();

    var url = "/absen/" + kelas + "/" + tanggal + "/" + campus + "/show";
    $("#listAbsen").load(url);

});



