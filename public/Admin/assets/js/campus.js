$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadTable();
});

function loadTable()
{
    var url = "/campus/table";
    $("#tableCampus").load(url);
}

function modalEdit(id)
{
    var url = '/campus/' + id + '/edit';
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            //isi data pada pada modal edit
            $("#campus_initial_edit").val(data.campus_initial);
            $("#npsn_edit").val(data.npsn)
            $("#campus_name_edit").val(data.campus_name);
            $("#campus_tingkat_edit").val(data.campus_tingkat);
            $("#campus_kepsek_edit").val(data.campus_kepsek);
            $("#niy_kepsek_edit").val(data.niy_kepsek);
            $("#campus_contact_edit").val(data.campus_contact);
            $("#campus_alamat_edit").val(data.campus_alamat);
            $("#idcampus").val(data.idcampus);
            $("#ytEdit").val(data.yt);
            $("#fbEdit").val(data.fb);
            $("#igEdit").val(data.ig);
            $("#teleEdit").val(data.tele);
            $("#email_campus_edit").val(data.email_campus);

            //tampilkan modal edit
            $("#editCampus").modal('show');
        }
    });
}

function updateCampus()
{
    var campus_initial = $("#campus_initial_edit").val();
    var campus_name = $("#campus_name_edit").val();
    var campus_tingkat = $("#campus_tingkat_edit").val();
    var campus_kepsek = $("#campus_kepsek_edit").val();
    var campus_contact = $("#campus_contact_edit").val();
    var campus_alamat = $("#campus_alamat_edit").val();
    var email_campus = $("#email_campus_edit").val();
    var niy_kepsek = $("#niy_kepsek_edit").val();
    var npsn = $("#npsn_edit").val();

    var yt = $("#ytEdit").val();
    var fb = $("#fbEdit").val();
    var ig = $("#igEdit").val();
    var tele = $("#teleEdit").val();
    var idcampus = $("#idcampus").val();
    var url = '/campus/' + idcampus + '/update';

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            campus_initial:campus_initial,
            campus_name:campus_name,
            campus_tingkat:campus_tingkat,
            campus_kepsek:campus_kepsek,
            niy_kepsek:niy_kepsek,
            campus_contact:campus_contact,
            campus_alamat:campus_alamat,
            yt:yt,
            fb:fb,
            ig:ig,
            tele:tele,
            email_campus:email_campus,
            idcampus:idcampus,
            npsn:npsn,
        }, success:function(response){
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            });
            //hide modal edit
            $("#editCampus").modal('hide');
            loadTable();
        }
    });
}

// live serach
function search()
{
    let key = $("#key").val();
    key=key.replace(/ /g,"_");
    if(key==0){
        loadTable();
    }else{
        var url = '/campus/' + key + '/search';
        $("#tableCampus").load(url);
    }

}