function loadKaldikBulan()
{
    var campus = $("#campus").val()
    var ta = $("#tahunAjaran").val()
    var url = "/nilai/kaldik/table/" + campus + "/" + ta + "/kaldikTable";
    $("#tableBulan").load(url)
}

function loadKeterangan()
{
    //var url = "/nilai/kaldik/loadKeterangan";
    var url = $("#keteranganKaldik").data("url");
    $("#keteranganKaldik").load(url)
    loadKeteranganModal()
}

function loadKeteranganModal()
{
    var url = "/kaldik/loadKeteranganModal/json";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(response){

            var select = $("#tag");
            select.empty();

            $.each(response, function (key, value){
                $("#tag").append('<option value="'+ value.id +'" class="bg-' + value.color + '">' + value.tag_name +'</option>');
            });
        },
        error: function() {
            console.error('Failed to load JSON file');
        }
    });
}



/**load ketika option di ganti */
$("#tahunAjaran").change(function(){
    loadKaldikBulan()
    loadKaldikTK()
});
$("#campus").change(function(){
    loadKaldikBulan()
    loadKaldikTK()
});

function resfreshKaldikTK() {
    // Tampilkan animasi loading sebelum memuat konten
    $("#loading").show();
    setTimeout(function() {
        loadKaldikTK();
    }, 1000); // Menunggu 1 detik sebelum memanggil loadKaldikTK()
}

/**Add Bulan */
function addBulan()
{
    $("#btnTambahBulan").attr('disabled', true)
    $("#btnTambahBulan").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var tahun = $("#tahun").val()
    var bulan = $("#bulan").val()
    var semester = $("#semester").val()
    var url = "/nilai/kaldik/bulan/add";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            tahun:tahun,
            bulan:bulan,
            semester:semester,
        },
        success:function(response){
            $("#btnTambahBulan").attr('disabled', false)
            $("#btnTambahBulan").html('<i class="bi bi-plus"></i> Tambahkan')
            loadKaldikBulan()
            $("#modalBaris").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function()
        {
            $("#btnTambahBulan").attr('disabled', false)
            $("#btnTambahBulan").html('<i class="bi bi-plus"></i> Tambahkan')
            loadKaldikBulan()
            $("#modalBaris").modal('hide')

            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal menambahkan baris!',
            });
        }
    });
}

//Unlock
function  unlockKaldik(id)
{
    var btnName = "#btnUnlockKaldik-" + id;
    $(btnName).attr('disabled', true)
    $(btnName).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var url = "/nilai/kaldik/unlock";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id
        },
        success:function(response){
            loadKaldikBulan()
        },
        error:function(){
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal membuka kunci!',
            });
        }
    });
}

//Lock
function  lockKaldik(id)
{
    var btnName = "#btnLockKaldik-" + id;
    $(btnName).attr('disabled', true)
    $(btnName).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var url = "/nilai/kaldik/lock";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id
        },
        success:function(response){
            loadKaldikBulan()
        },
        error:function(){
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal membuka kunci!',
            });
        }
    });
}

/**Keterangan */
function modalKeterangan()
{
    $("#modalKeterangan").modal('show')
}

function addKeterangan()
{
    $("#btnTambahKeterangan").attr('disabled', true)
    $("#btnTambahKeterangan").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var url = "/nilai/kaldik/addKeterangan";
    var warna = $("#warna").val()
    var keterangan = $("#keterangan").val()

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            keterangan:keterangan,
            warna:warna,
        },
        success:function(response){
            $("#btnTambahKeterangan").attr('disabled', false)
            $("#btnTambahKeterangan").html('<i class="bi bi-plus"></i> Tambahkan')
            loadKeterangan()
            $("#modalKeterangan").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function()
        {
            $("#btnTambahKeterangan").attr('disabled', false)
            $("#btnTambahKeterangan").html('<i class="bi bi-plus"></i> Tambahkan')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menambahkan Keterangan!',
            });
        }
    });
}

function modalUpdateTagHariKaldik(id)
{
    $("#idhari").val(id)
    $("#modalAddKeterangan").modal('show');
}

function addKeteranganTanggal()
{
    $("#btnTambahKeteranganTanggal").attr('disabled', true)
    $("#btnTambahKeteranganTanggal").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var url = "/kaldik/addKeterangan/hari";
    var tag = $("#tag").val()
    var id = $("#idhari").val()

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            tag:tag,
            id:id,
        },
        success:function(response){
            $("#btnTambahKeteranganTanggal").attr('disabled', false)
            $("#btnTambahKeteranganTanggal").html('<i class="bi bi-plus"></i> Add')
            loadKaldikBulan()
            $("#modalAddKeterangan").modal('hide');
            console.log(response.message)
        },
        error:function(){
            $("#btnTambahKeteranganTanggal").attr('disabled', false)
            $("#btnTambahKeteranganTanggal").html('<i class="bi bi-plus"></i> Add')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menambahkan Keterangan!',
            });
        }
    });
}

/**Update Keterangan */
function modalUpdateKeterangan(id, tag, color)
{
    $("#btnEditKeterangan").data('id', id);
    $("#keteranganEdit").val(tag)
    $("#warnaEdit").val(color)

    $("#modalEditKeterangan").modal('show')
}
function updateKeterangan()
{
    $("#btnEditKeterangan").attr('disabled', true)
    $("#btnEditKeterangan").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var id = $("#btnEditKeterangan").data('id')
    var tag_name = $("#keteranganEdit").val()
    var color = $("#warnaEdit").val()
    var url = "/kaldik/update/keterangan";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            tag_name:tag_name,
            color:color,
        },
        success:function(response){
            $("#btnEditKeterangan").attr('disabled', false)
            $("#btnEditKeterangan").html('<i class="bi bi-plus"></i> Update')
            loadKeterangan()
            loadKaldikBulan()
            $("#modalEditKeterangan").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function()
        {
            $("#btnEditKeterangan").attr('disabled', false)
            $("#btnEditKeterangan").html('<i class="bi bi-plus"></i> Update')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menambahkan Keterangan!',
            });
        }
    });
}

/**Delete Keterangan */
function deleteKeterangan(id)
{
    $("#idKeterangan").val(id)
    $("#modalDeleteKeterangan").modal('show')
}
function deleteKeteranganTanggal()
{
    $("#btnDeleteKeteranganTanggal").attr('disabled', true)
    $("#btnDeleteKeteranganTanggal").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var id = $("#idKeterangan").val()
    var url = "/kaldik/delete/keterangan";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id
        },
        success:function(response){
            $("#btnDeleteKeteranganTanggal").attr('disabled', false)
            $("#btnDeleteKeteranganTanggal").html('<i class="bi bi-trash"></i> Hapus')
            $("#modalDeleteKeterangan").modal('hide')
            loadKaldikBulan()
            loadKeterangan()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });

        },
        error:function(){
            $("#btnDeleteKeteranganTanggal").attr('disabled', false)
            $("#btnDeleteKeteranganTanggal").html('<i class="bi bi-trash"></i> Hapus')
            $("#modalDeleteKeterangan").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menghapus Data!',
            });
        }
    });
}

/**Delete Bulan */
function confirmDeleteBulan(id)
{
    console.log(id)
    $("#idBulan").val(id)
    $("#modalDeleteBulan").modal('show')
}

function deleteBulan()
{
    $("#btnDeleteBulan").attr('disabled', true)
    $("#btnDeleteBulan").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var id = $("#idBulan").val()
    var url = "/kaldik/delete/bulan";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            $("#btnDeleteBulan").attr('disabled', false)
            $("#btnDeleteBulan").html('<i class="bi bi-trash"></i> Hapus')
            $("#modalDeleteBulan").modal('hide')
            loadKaldikBulan()
            loadKeterangan()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(){
            $("#btnDeleteBulan").attr('disabled', false)
            $("#btnDeleteBulan").html('<i class="bi bi-trash"></i> Hapus')
            $("#modalDeleteBulan").modal('hide')
            /**Alert */
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: 'Gagal Menghapus Data!',
            });
        }
    });
}


/**TK
 * *************************
 */

function uploadKaldikTK()
{
    $("#btnUploadKaldikTK").attr('disabled', true)
    $("#btnUploadKaldikTK").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var campus_id = $("#campus").val()
    var fileInput = document.getElementById('files');
    var file = fileInput.files[0];
    var ta = $("#tahunAjaran").val();
    var file_name = $("#file_name").val();
    var url ="/kaldik/tk/upload";

    var formData = new FormData();
    formData.append('campus_id', campus_id);
    formData.append('file', file);
    formData.append('ta', ta);
    formData.append('file_name', file_name);

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        processData:false,
        contentType:false,
        data:formData,
        success:function(response){
            $("#btnUploadKaldikTK").attr('disabled', false)
            $("#btnUploadKaldikTK").html('<i class="bi bi-upload"></i> Upload')
            loadKaldikTK()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(xhr, status, error){
            $("#btnUploadKaldikTK").attr('disabled', false)
            $("#btnUploadKaldikTK").html('<i class="bi bi-upload"></i> Upload')

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

function resfreshKaldikTK() {
    // Tampilkan animasi loading sebelum memuat konten
    $("#loading").show();
    $("#btnRefreshKaldikTK").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Refresh...')
    setTimeout(function() {
        loadKaldikTK();
    }, 1000); // Menunggu 1 detik sebelum memanggil loadKaldikTK()
}

function loadKaldikTK() {
    var campus = $("#campus").val();
    var ta = $("#tahunAjaran").val();
    var url = "/kaldik/tk/" + campus + "/" + ta + "/loadFile";

    // Memuat konten Kaldik TK
    $("#fileKaldikTK").load(url, function() {
        // Sembunyikan animasi loading setelah konten dimuat
        $("#loading").hide();
        $("#btnRefreshKaldikTK").html('<i class="bi bi-arrow-repeat"></i> Refresh')
    });
}

function confirmDeleteKaldikTK(id)
{
    $("#idKaldikTK").val(id)
    $("#modalDeleteKaldikTK").modal('show');
}

function deleteKaldikTK()
{
    $("#btnDeleteKaldikTK").attr('disabled', true)
    $("#btnDeleteKaldikTK").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Processing...')
    var id = $("#idKaldikTK").val()
    var url = "/kaldik/tk/delete";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },
        success:function(response){
            $("#btnDeleteKaldikTK").attr('disabled', false)
            $("#btnDeleteKaldikTK").html('<i class="bi bi-trash"></i> Hapus')
            $("#modalDeleteKaldikTK").modal('hide');
            loadKaldikTK()
            resfreshKaldikTK()
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.message,
            });
        },
        error:function(){
            $("#btnDeleteKaldikTK").attr('disabled', false)
            $("#btnDeleteKaldikTK").html('<i class="bi bi-trash"></i> Hapus')
            /**Alert */
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Gagal Menghapus Data!',
            });
        }
    });
}


/**
 * END TK
 * *************************
 */