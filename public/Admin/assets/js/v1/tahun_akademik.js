$("#error-message").hide();

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    load()
});

function load()
{
    $("#tabel-tahun-akademik").load("/tahun_akademik/table");
}

$("#button-addon").click(function(){
    /**Animasi */
    $("#button-addon").attr('Disabled', true);
    $("#button-addon").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...');

    var url = "/tahun_akademik";
    var tahun = $("#tahun").val();
    var semester = $("#semester").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            tahun:tahun,
            semester:semester,
        },
        success:function(response){
            /**Animasi */
            $("#button-addon").attr('Disabled', false);
            $("#button-addon").html('Tambah');

            $("#modalAdd").modal('hide')
            /**Load Data */
            load()

            /**Animasi */
            Swal.fire({
                icon:'success',
                title: 'Congrats...',
                text : response.success,
            });
        },
        error:function(xhr, status, error){
            /**Animasi */
            $("#button-addon").attr('Disabled', false);
            $("#button-addon").html('Tambah');

            $('#error-message').show();
            $('#error-message').html('');

            // Handle error response
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;

                // Display validation errors
                $.each(errors, function(key, value) {
                    $('#error-message').append('<p><i class="bi bi-exclamation-circle"></i> ' + value + '</p>');
                });
            } else {
                // Log the entire response for debugging
                console.log(xhr.responseText);
                $('#error-message').html('<p>Error: Unable to process the request.</p>');
            }
        }
    });
});

function editTA(id, ta, semester)
{
    $("#idsm").val(id)
    $("#tahun-edit").val(ta)
    $("#semester-edit").val(semester)
    $("#modalEdit").modal('show')
}

$("#btn-update").click(function(){
    /**Animasi */
    $("#btn-update").attr('Disabled', true);
    $("#btn-update").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Update');

    var url = "/tahun_akademik/update";
    var idsm = $("#idsm").val()
    var semester = $("#semester-edit").val()
    var tahun = $("#tahun-edit").val()

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idsm:idsm,
            semester:semester,
            tahun:tahun,
        },
        success:function(response){
            /**Animasi */
            $("#btn-update").attr('Disabled', false);
            $("#btn-update").html('Update');

            /**Load Data */
            load()

            /**Notifikasi */
            notifSuccess(response)
        },
        error:function(xhr, status, error){
            notifError(xhr, status, error)
        }
    });
});

function setActive(id, tahun, semester)
{
    var semesterText = '';

    if(semester === '1'){
        semesterText = 'Ganjil';
    }else if(semester === '2'){
        semesterText = 'Genap';
    }

    $("#idsm-active").val(id)
    $("#alert-tahun-ajaran").text(tahun)
    $("#alert-semester").text(semesterText)
    $("#modalActive").modal('show')
}

function setActiveProses()
{
    /**Animasi */
    $("#btn-active").attr('Disabled', true);
    $("#btn-active").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Ya');

    var url = "/tahun_akademik/setActive";
    var id = $("#idsm-active").val()

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            /**Animasi */
            $("#btn-active").attr('Disabled', false);
            $("#btn-active").html('<i class="bi bi-check-lg"></i> Ya');

            $("#modalActive").modal('hide');

            notifSuccess(response)
            load()
        },
        error:function(xhr, status, error){
            notifError(xhr, status, error)
        }
    });
}

function confirmDeleteSemester(id, tahun, semester)
{
    var semesterText = '';

    if(semester === '1'){
        semesterText = 'Ganjil';
    }else if(semester === '2'){
        semesterText = 'Genap';
    }

    $("#idsm-delete").val(id)
    $("#alert-tahun-ajaran-del").text(tahun)
    $("#alert-semester-del").text(semesterText)
    $("#modalDelete").modal('show')
}

function deleteSemester()
{
    /**Animasi */
    $("#delete-semester").attr('Disabled', true);
    $("#delete-semester").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Ya');

    var url = "/tahun_akademik/delete/semester";
    var id = $("#idsm-delete").val()

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            /**Animasi */
            $("#delete-semester").attr('Disabled', false);
            $("#delete-semester").html('<i class="bi bi-check-lg"></i> Ya');

            $("#modalDelete").modal('hide');

            notifSuccess(response)
            load()
        },
        error:function(xhr, status, error){
            notifError(xhr, status, error)
        }
    });
}


/**Notifikasi */
function notifSuccess(response)
{
    /**Notifikasi */
    Swal.fire({
        icon:'success',
        title: 'Congrats...',
        text : response.message,
    });
}
function notifError(xhr, status, error)
{
    // Handle error response
    if (xhr.responseJSON && xhr.responseJSON.errors) {
        var errors = xhr.responseJSON.errors;

        // Display validation errors
        $.each(errors, function(key, value) {
            $('#error-message').append('<p><i class="bi bi-exclamation-circle"></i> ' + value + '</p>');
        });
    } else {
        // Log the entire response for debugging
        console.log(xhr.responseText);
        $('#error-message').html('<p>Error: Unable to process the request.</p>');
    }
}
/**End Notifikasi */