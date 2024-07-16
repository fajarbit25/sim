$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    tabelMapel();
});

function tabelMapel()
{
    var url = "/mapel/table";
    $("#tabel-mapel").load(url);
}

function modalUpdate(id)
{
    // $("#modalUpdate").modal('show');
    $("#idDelete").val(id);

    var url = "/mapel/" + id + "/edit";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            $("#kode_mapel_edit").val(data.kode_mapel);
            $("#nama_mapel_edit").val(data.nama_mapel);
            $("#jenis_edit").val(data.jenis);
            $("#kkm_edit").val(data.kkm);
            $("#modalUpdate").modal('show');
        }

    });
}

function updateMapel()
{
    var url = "/mapel/update";
    var idmapel = $("#idDelete").val();
    var kode_mapel = $("#kode_mapel_edit").val();
    var nama_mapel = $("#nama_mapel_edit").val();
    var jenis = $("#jenis_edit").val();
    var kkm = $("#kkm_edit").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idmapel:idmapel,
            kode_mapel:kode_mapel,
            nama_mapel:nama_mapel,
            kkm:kkm,
            jenis:jenis,
        },success:function(response){
            tabelMapel();
            $("#modalUpdate").modal('hide');
            console.log('updated');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Mapel Has updated!',
            });
        }
    });
}

function modalDelete(id)
{
    $("#modalDelete").modal('show');
    $("#idmapelDelete").val(id);
}

function deleteMapel()
{
    var url = "/mapel/destroy";
    var idmapel = $("#idmapel").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{idmapel:idmapel},
        success:function(response){

            tabelMapel();
            $("#modalDelete").modal('hide');

            console.log('deleted');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Mapel Has deleted!',
            });
        }
    });
}


//search function
function search()
{   
    let key = $("#key").val();
    key=key.replace(/ /g,"_");
    if(key==0){
        tabelMapel();
    }else{
        url = "/mapel/" +  key + "/search";
        $("#tabel-mapel").load(url);
    } 
}

//pagination function
function paginate(url)
{
    let link = '/mapel/table?page=' + url;
    $("#tabel-mapel").load(link);
}