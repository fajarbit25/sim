$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log('ready');
    loadAkun();
    loadFotoUser();
    $("#btnLoadingFoto").hide();
    $("#btnLoadingAkun").hide();
});

function loadAkun()
{
    var url = "/profile/akun";
    $("#formAkun").load(url);
}

function loadFotoUser()
{
    var url = "/profile/image";
    $("#foto-user").load(url);
}

function uploadFoto()
{
    /**Animasi Loading */
    $("#btnSubmitFoto").hide();
    $("#btnLoadingFoto").show();
    
    var url = "/profile/change_image";
    var form = $("#FormFoto")[0];
    var data = new FormData(form);

    $.ajax({
        url:url,
        data:data,
        type:'POST',
        processData:false,
        contentType:false,
        success:function(response){
            /**Animasi Loading */
            $("#btnSubmitFoto").show();
            $("#btnLoadingFoto").hide();

            /**Load data */
            loadAkun();
            loadFotoUser();

            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Image Has changed!',
            });
        }, error:function(response){
            /**Animasi Loading */
            $("#btnSubmitFoto").show();
            $("#btnLoadingFoto").hide();

            /**Load data */
            loadAkun();
            loadFotoUser();

            /**Alert */
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'change Image Fail.!',
            });
        }
    });
    

}

function updateAkun()
{
    /**Animasi */
    $("#btnLoadingAkun").show();
    $("#btnSubmitAkun").hide();

    /**Variable */
    var url             = "/profile/akun";
    var first_name      = $("#first_name").val();
    var email           = $("#email").val();
    var phone           = $("#phone").val();
    var telephone       = $("#telephone").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            first_name:first_name,
            email:email,
            phone:phone,
            telephone:telephone,
        }, success:function(response){
            /**Animasi */
            $("#btnLoadingAkun").hide();
            $("#btnSubmitAkun").show();

            /**Load data */
            loadAkun();
            loadFotoUser();

            Swal.fire({
                icon: 'success',
                title: 'Congrats..',
                text: 'Profile Updated...',
            });

        }, error:function(response){
            /**Animasi */
            $("#btnLoadingAkun").hide();
            $("#btnSubmitAkun").show();

            /**Load data */
            loadAkun();
            loadFotoUser();

            Swal.fire({
                icon: 'warning',
                title: 'Congrats..',
                text: 'Update Profile Fails...',
            });
        }
    });
}





