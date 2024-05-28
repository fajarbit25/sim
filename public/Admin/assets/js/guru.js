$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#btn-loading").hide();
    $("#btn-loadEdit").hide();
    $("#btn-loading-mapel").hide();
    loadFoto();
    loadDetails();
});

function deleteGuru(id)
{
    $("#id").val(id);
    $("#modalDelete").modal('show');
    console.log('deleted');
}

function loadFoto()
{
    var id = $("#idusers").val();
    var url = "../" + id + "/foto";
    $("#load-foto").load(url);
    
}

function loadDetails()
{
    var id = $("#idusers").val();
    var url = "../" + id + "/detail";
    var urlMapel = "/guru/" + id + "/tabelMapel";
    $("#profile-overview").load(url);
    $("#tableMapel").load(urlMapel);
}

function ladFormEdit()
{
    var id = $("#idusers").val();
    var url = "/single/" + id + "/show";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            $("#first_name").val(data.guru.first_name);
            $("#email").val(data.guru['email']);
            $("#phone").val(data.guru['phone']);
            $("#level").val(data.guru['level']);
            $("#nip").val(data.teacher['nip']);
        }
    });
}


function changeImage()
{
    //Loading Animation
    $("#btn-upload").hide();
    $("#btn-loading").show();

    var form = $("#photoForm")[0];
    var data = new FormData(form);
    var url = "/guru/change_image";
    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            
            //Loading Animation
            $("#btn-upload").show();
            $("#btn-loading").hide();
            loadFoto();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Image Has changed!',
            });
        }, error:function(response){
            loadFoto();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'change Image Fail.',
            });
        }
    });
}

function saveEdit()
{
    //Loading Animasi
    $("#btn-loadEdit").show();
    $("#btn-edit").hide();

    var url             = "/guru/update";
    var id              = $("#idusers").val();
    var first_name      = $("#first_name").val();
    var ibu_kandung     = $("#ibu_kandung").val();
    var gender          = $("#gender").val();
    var tempat_lahir    = $("#tempat_lahir").val();
    var tanggal_lahir   = $("#tanggal_lahir").val();
    var email           = $("#email").val();
    var phone           = $("#phone").val();
    var level           = $("#level").val();
    var nip             = $("#nip").val();
    var agama           = $("#agama").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            first_name:first_name,
            ibu_kandung:ibu_kandung,
            gender:gender,
            tempat_lahir:tempat_lahir,
            tanggal_lahir:tanggal_lahir,
            email:email,
            phone:phone,
            level:level,
            nip:nip,
            agama:agama,
        }, success:function(response){
            console.log(response.success);
            loadFoto();
            loadDetails();
            ladFormEdit();

            //Loading Animasi
            $("#btn-loadEdit").hide();
            $("#btn-edit").show();

            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }, error:function(response){
            //Loading Animasi
            $("#btn-loadEdit").hide();
            $("#btn-edit").show();

            Swal.fire({
                icon: 'warning',
                title: 'Congrats...',
                text: 'Gagal',
            });
        }
    });
}

$("#btn-mapel").click(function(){
    $("#modalMapel").modal('show');
});

function addMapel()
{
    /**Animasi */
    $("#btn-submit-mapel").hide();
    $("#btn-loading-mapel").show();

    var id = $("#idusers").val();
    var mapel = $("#mapel").val();
    var kelas = $("#kelas").val();
    var url = "/guru/mapel/add";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            mapel:mapel,
            kelas:kelas,
        },
        success:function(response){
            /**Animasi */
            $("#btn-loading-mapel").hide();
            $("#btn-submit-mapel").show();
            $("#modalMapel").modal('hide');
            loadDetails();

        },
        error:function(){
            /**Animasi */
            $("#btn-loading-mapel").hide();
            $("#btn-submit-mapel").show();

            /**Notifikasi */
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Terjadi Kesalahan',
            });
        }
    });
}


function removeMapel(id)
{
    console.log(id)
    var namaBtn = "#btn-remove-"+ id;
    var url = '/guru/mapel/delete';
    $(namaBtn).attr('Disabled', true);
    $(namaBtn).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>');

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            loadDetails();
            /**Notifikasi */
            Swal.fire({
                icon: 'success',
                title: 'Alert...',
                text: response.success,
            });
        },
        error:function(){
            loadDetails();
            /**Notifikasi */
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Terjadi Kesalahan',
            });
        }
    });
}