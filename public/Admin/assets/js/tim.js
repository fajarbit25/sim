$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnLoading").hide();
    $("#btnBack").hide();

    loadFoto();
});

function loadFoto()
{
    var idteam = $("#idteam").val();
    var url = '/tim/' + idteam + '/foto';
    $("#fotoTim").load(url);
}

function addTim()
{
    /**Animasi */
    $("#btnSubmit").hide();
    $("#btnLoading").show();

    var url = "/tim/add";
    var form = $("#formTim")[0];
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            /**Animasi */
            $("#btnSubmit").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            })
        },
        error:function(){
            /**Animasi */
            $("#btnSubmit").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Something wrong..',
            })
        }
    });

}

function editTim()
{
    /**Animasi */
    $("#btnSubmit").hide();
    $("#btnLoading").show();

    var url = "/tim/update";
    var nama = $("#nama").val();
    var jabatan = $("#jabatan").val();
    var twitter = $("#twitter").val();
    var fb = $("#fb").val();
    var ig = $("#ig").val();
    var linked = $("#linked").val();
    var idteam = $("#idteams").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            nama:nama,
            jabatan:jabatan,
            twitter:twitter,
            fb:fb,
            ig:ig,
            linked:linked,
            idteam:idteam,
        }, success:function(response){
            /**Animasi */
            $("#btnSubmit").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            loadFoto();

            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            })
        }, error:function(){
            /**Animasi */
            $("#btnSubmit").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            loadFoto();

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Something wrong..',
            })
        }
    });
}

function timDelete()
{
    /**Animasi */
    $("#btnDelete").hide();
    $("#btnLoading").show();

    var idteam = $("#idteams").val();
    var url = "/tim/delete";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idteam:idteam,
        }, success:function(response){
            /**Animasi */
            $("#btnDelete").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            loadFoto();

            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            })
        }, error:function(){
            /**Animasi */
            $("#btnDelete").show();
            $("#btnLoading").hide();
            $("#btnBack").show();
            loadFoto();

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Something wrong..',
            })
        }
    });

}

function updateFoto()
{
    $("#inputGroupFileAddon04").html('Loading...');

    var url = "/tim/update/foto";
    var form = $("#formFoto")[0];
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            /**Animasi */
            $("#inputGroupFileAddon04").html('Upload');
            loadFoto();
            $("#btnBack").show();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            })
        },
        error:function(){
            /**Animasi */
            $("#inputGroupFileAddon04").html('Upload');
            loadFoto();
            $("#btnBack").show();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Something wrong..',
            })
        }
    });
}