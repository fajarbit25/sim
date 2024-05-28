$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log('ready');
    $("#btn-loading").hide();
    loadTable();
});

function loadTable()
{
    $("#tableLevel").load("/level/table");
    console.log('load table ok');
}

function save()
{
    $("#btn-submit").hide();
    $("#btn-loading").show();

    var url = "/level";
    var kode = $("#kode_level").val();
    var nama = $("#nama_level").val();
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            kode_level:kode,
            nama_level:nama,
        }, success:function(response){
            $("#btn-submit").show();
            $("#btn-loading").hide();
            console.log('stored');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Image Has changed!',
            });
        }
    });
}

function modalDelete()
{
    $("#modalDelete").show();
}