function loadDailyReport()
{
    var url = "/tk/ajax/tableDailyReport";
    $("#tableDailyReport").load(url)
}

function addKeterangan()
{
    $("#btnAddKeterangan").attr('disabled', true)
    $("#btnAddKeterangan").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
    var url = "/tk/dr/addKeterangan";
    var keterangan = $("#keterangan").val()
    
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            keterangan:keterangan,
        },
        success:function(response){
            $("#btnAddKeterangan").attr('disabled', false)
            $("#btnAddKeterangan").html('<i class="bi bi-check-circle-fill"></i> Save')
            loadDailyReport()
            $("#keterangan").val("")
            $("#modalAddKeterangan").modal('hide')
        },
        error:function()
        {
            $("#btnAddKeterangan").attr('disabled', false)
            $("#btnAddKeterangan").html('<i class="bi bi-check-circle-fill"></i> Save')
            console.log('error')
        }
    });
    
}

$("#btnModalAddKeterangan").click(function(){
    $("#modalAddKeterangan").modal('show')
});

function modalFoto(jenis)
{
    console.log(jenis)
    $("#modalUploadFoto").modal('show')
}

function UploadFoto()
{
    $("#inputGroupFileAddon04").attr('disabled', true)
    $("#inputGroupFileAddon04").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var fileInput = document.getElementById('inputGroupFile04');
    var file = fileInput.files[0];
    var jenis = 'Upload';
    var url ="/tk/dr/upload";

    var formData = new FormData();
    formData.append('file', file);
    formData.append('jenis', jenis);

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        processData:false,
        contentType:false,
        data:formData,
        success:function(response){
            $("#inputGroupFileAddon04").attr('disabled', false)
            $("#inputGroupFileAddon04").html('<i class="bi bi-upload"></i> Upload')
            loadDailyReport()
            loadDokumentasi()
            $("#modalUploadFoto").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(xhr, status, error){
            $("#inputGroupFileAddon04").attr('disabled', false)
            $("#inputGroupFileAddon04").html('<i class="bi bi-upload"></i> Upload')

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

function addSubTema(id)
{
    var btnName = "#btnAddSubTema-" + id;
    $(btnName).attr('disabled', true);
    $(btnName).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Save')

    var formName = "#inputSubTema-" + id;
    var subKeterangan = $(formName).val()
    var url = "/tk/dr/subtema";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            subKeterangan:subKeterangan,
            id:id,
        },
        success:function(response){
            loadDailyReport()
        },
        error:function(){
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menambahkan Subtema,',
            });
        }
    });
}

function subTema(id)
{
    var url = "/tk/dr/addSubTema";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            loadDailyReport()
        },
        error:function(){
            console.log('error')
        }
    });
}

function deleteKeterangan(id)
{
    var url = "/tk/dr/delete";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            loadDailyReport()
        },
        error:function(){
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal menghapus,',
            });
        }
    });
}

function deleteSubTema(id)
{
    var url = "/tk/dr/deleteSub";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            loadDailyReport()
        },
        error:function(){
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menghapus,',
            });
        }
    });
}

function loadDokumentasi()
{
    var url = "/tk/dr/loadData/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            if(data.countFoto === 1){
                $("#fotoDailyReport").append("<img src='/storage/tk-daily/" + data.dailyReport.foto + "') alt='Foto' style='max-width: 100%; height: auto;' />");
            }
        }
    });
}