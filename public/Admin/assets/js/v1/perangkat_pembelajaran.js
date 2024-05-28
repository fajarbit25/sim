function loadAll()
{
    loadSilabus()
}

function loadSilabus()
{
    var ta = $("#tahunAjaran").val()
    var campus = $("#campus").val()
    var url = "/pb/" + campus + "/" + ta + "/silabus";
    $("#v-pills-silabus").load(url)
}

function loadProta()
{
    var ta = $("#tahunAjaran").val()
    var campus = $("#campus").val()
    var url = "/pb/" + campus + "/" + ta + "/prota";
    $("#v-pills-prota").load(url)
}

function loadProsem()
{
    var ta = $("#tahunAjaran").val()
    var campus = $("#campus").val()
    var url = "/pb/" + campus + "/" + ta + "/prosem";
    $("#v-pills-prosem").load(url)
}

$("#tahunAjaran").change(function(){
    loadSilabus()
    loadProta()
    loadProsem()
});

$("#campus").change(function(){
    loadSilabus()
    loadProta()
    loadProsem()
});


function uploadSilabus()
{
    $("#inputGroupFileAddonSilabus").attr('disabled', true)
    $("#inputGroupFileAddonSilabus").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var campus_id = $("#campus").val()
    var fileInput = document.getElementById('inputGroupFileSilabus');
    var file = fileInput.files[0];
    var ta = $("#tahunAjaran").val();
    var table = 'Silabus';
    var url ="/pb/upload";

    var formData = new FormData();
    formData.append('campus_id', campus_id);
    formData.append('file', file);
    formData.append('ta', ta);
    formData.append('table', table);

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        processData:false,
        contentType:false,
        data:formData,
        success:function(response){
            $("#inputGroupFileAddonSilabus").attr('disabled', false)
            $("#inputGroupFileAddonSilabus").html('<i class="bi bi-upload"></i> Upload')
            loadSilabus()
            loadProsem()
            loadProta()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(xhr, status, error){
            $("#inputGroupFileAddonSilabus").attr('disabled', false)
            $("#inputGroupFileAddonSilabus").html('<i class="bi bi-upload"></i> Upload')

            // Tanggapan kesalahan dari server
            if (xhr.status === 422) {
                // Tanggapan status 422 (Unprocessable Entity)
                // Menampilkan pesan kesalahan validasi
                var errors = xhr.responseJSON.errors;
                var errorMessages = "";
                $.each(errors, function(key, value) {
                    errorMessages += value;

                });

                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: errorMessages,
                });
                
            } else {
                // Tanggapan kesalahan lainnya
                console.error(xhr.responseText);
                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: 'Upload Gagal,',
                });

            }
        }
    });

}

function uploadProta()
{
    $("#inputGroupFileAddonProta").attr('disabled', true)
    $("#inputGroupFileAddonProta").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var campus_id = $("#campus").val()
    var fileInput = document.getElementById('inputGroupFileProta');
    var file = fileInput.files[0];
    var ta = $("#tahunAjaran").val();
    var table = 'Prota';
    var url ="/pb/upload";

    var formData = new FormData();
    formData.append('campus_id', campus_id);
    formData.append('file', file);
    formData.append('ta', ta);
    formData.append('table', table);

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        processData:false,
        contentType:false,
        data:formData,
        success:function(response){
            $("#inputGroupFileAddonProta").attr('disabled', false)
            $("#inputGroupFileAddonProta").html('<i class="bi bi-upload"></i> Upload')
            loadSilabus()
            loadProsem()
            loadProta()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(xhr, status, error){
            $("#inputGroupFileAddonProta").attr('disabled', false)
            $("#inputGroupFileAddonProta").html('<i class="bi bi-upload"></i> Upload')

            // Tanggapan kesalahan dari server
            if (xhr.status === 422) {
                // Tanggapan status 422 (Unprocessable Entity)
                // Menampilkan pesan kesalahan validasi
                var errors = xhr.responseJSON.errors;
                var errorMessages = "";
                $.each(errors, function(key, value) {
                    errorMessages += value;

                });

                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: errorMessages,
                });
                
            } else {
                // Tanggapan kesalahan lainnya
                console.error(xhr.responseText);
                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: 'Upload Gagal,',
                });

            }
        }
    });

}

function uploadProsem()
{
    $("#inputGroupFileAddonProsem").attr('disabled', true)
    $("#inputGroupFileAddonProsem").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var campus_id = $("#campus").val()
    var fileInput = document.getElementById('inputGroupFileProsem');
    var file = fileInput.files[0];
    var ta = $("#tahunAjaran").val();
    var table = 'Prosem';
    var url ="/pb/upload";

    var formData = new FormData();
    formData.append('campus_id', campus_id);
    formData.append('file', file);
    formData.append('ta', ta);
    formData.append('table', table);

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        processData:false,
        contentType:false,
        data:formData,
        success:function(response){
            $("#inputGroupFileAddonProsem").attr('disabled', false)
            $("#inputGroupFileAddonProsem").html('<i class="bi bi-upload"></i> Upload')
            loadSilabus()
            loadProsem()
            loadProta()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(xhr, status, error){
            $("#inputGroupFileAddonProsem").attr('disabled', false)
            $("#inputGroupFileAddonProsem").html('<i class="bi bi-upload"></i> Upload')

            // Tanggapan kesalahan dari server
            if (xhr.status === 422) {
                // Tanggapan status 422 (Unprocessable Entity)
                // Menampilkan pesan kesalahan validasi
                var errors = xhr.responseJSON.errors;
                var errorMessages = "";
                $.each(errors, function(key, value) {
                    errorMessages += value;

                });

                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: errorMessages,
                });
                
            } else {
                $("#inputGroupFileAddonProsem").attr('disabled', false)
                $("#inputGroupFileAddonProsem").html('<i class="bi bi-upload"></i> Upload')

                // Tanggapan kesalahan lainnya
                console.error(xhr.responseText);
                /**Alert */
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: 'Upload Gagal,',
                });

            }
        }
    });

}

function confirmDeletePb(id, table)
{
    $("#idPb").val(id);
    $("#table").val(table)
    $("#textAlert").text(table)
    $("#modalDelete").modal('show');
}

function deletePbProcessing()
{
    $("#btnDeletePb").attr('disabled', true)
    $("#btnDeletePb").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var id = $("#idPb").val()
    var table = $("#table").val()
    var url = "/pb/delete"

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            table:table,
        },
        success:function(response){
            $("#btnDeletePb").attr('disabled', false)
            $("#btnDeletePb").html('<i class="bi bi-trash"></i> Hapus')
            loadSilabus()
            loadProsem()
            loadProta()
            $("#modalDelete").modal('hide');
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: response.message,
            });
        },
        error:function(){
            $("#btnDeletePb").attr('disabled', false)
            $("#btnDeletePb").html('<i class="bi bi-trash"></i> Hapus')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Upload Gagal,',
            });
        }
    });

}