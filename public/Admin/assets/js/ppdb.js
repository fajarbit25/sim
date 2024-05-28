$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    load_form_doc();
    load_keb_khusus();
    load_keb_khusus_wali();
    loadPrestasi();
    loadBeasiswa();
    loadKes();
    disableLink()

    $("#animation").hide();
    $("#negaraRow").hide();
    $("#btnLoadingPrestasi").hide();
    $("#btnLoadingBeasiswa").hide();
    $("#btnLoadingKes").hide();
    
});

function disableLink()
{
    var url = "/ppdb/get_fileCount";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(response){
            if(response[0].akta_lahir !== null && response[0].kk !== null && response[0].ktp_ortu !== null && response[0].foto !== null){
                $("#linkNext").show();
            }else{
                $("#linkNext").hide();
            }
        }, error:function(){
            $("#linkNext").hide();
        }
    });
    $("#linkNext").hide();
}

function load_form_doc()
{
    var url = "/ppdb/upload/doc/form";
    $("#formUploadDoc").load(url);
}

/**Akta Lahir */
function upload_aktaLahir()
{
    $("#animation").show();
    var form = $("#formAktaLahir")[0];
    var url = "/akta_lahir";
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            });
        },
        error:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon: 'success',
                title: 'Oops...',
                text: 'Upload Gagal',
            });
        }
    });
}

function delete_document(id)
{
    $("#animation").show();
    var url = "/ppdb/delete_document";

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{field:id},
        success:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}


function uploadKK()
{
    $("#animation").show();
    var form = $("#formKK")[0];
    var url = "/kartu_keluarga";
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}

function upload_ktp()
{
    $("#animation").show();
    var form = $("#formKTP")[0];
    var url = "/ktp_ortu";
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}

function uploadFoto()
{
    $("#animation").show();
    var form = $("#formFoto")[0];
    var url = "/pas_foto";
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            $("#animation").hide();
            disableLink();
            load_form_doc();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}

/**Form Input Nama Negara */
$("#kewarganegaraan").change(function(){

    var negara = $("#kewarganegaraan").val();
    if(negara == 'WNA'){
        $("#negara").val('');
        $("#negaraRow").show();
    }else{
        $("#negara").val('Indonesia');
        $("#negaraRow").hide();
    }
});


/** Load Form Keb Khusus */
function load_keb_khusus()
{
    var segment = "siswa";
    var url = "/ppdb/form_keb_khusus/"+ segment + "/show";
    $("#keb-khusus").load(url);
}
function load_keb_khusus_wali()
{
    var segment = $("#segment").val();
    //var url = "/ppdb/form_keb_khusus_wali/"+ segment + "/show";
    var url = "/ppdb/form_keb_khusus_wali/"+segment+"/show";
    $("#keb-khususWali").load(url);
}

function add_keb_khusus()
{
    var url = "/ppdb/add_keb_khusus";
    var kebutuhan_khusus = $("#kebutuhan_khusus").val();
    var segment = $("#segment").val();
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            kebutuhan_khusus:kebutuhan_khusus,
            segment:segment,
        },success:function(response){
            $("#exampleModal").modal('hide'); 
            load_keb_khusus();
            load_keb_khusus_wali(); 
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}

function delete_keb_khusus(id)
{
    var url = "/ppdb/del_keb_khusus";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
        },success:function(response){
            load_keb_khusus();
            load_keb_khusus_wali();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }
    });
}

/**Prestasi */
function loadPrestasi()
{
    var url = "/ppdb/prestasi/table";
    $("#tablePrestasi").load(url);
}

function savePrestasi()
{
    $("#btnSavePrestasi").hide();
    $("#btnLoadingPrestasi").show();

    var url = "/ppdb/prestasi";
    var jenis = $("#jenis").val();
    var tingkat = $("#tingkat").val();
    var nama_prestasi = $("#nama_prestasi").val();
    var tahun = $("#tahun").val();
    var penyelenggara = $("#penyelenggara").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            jenis:jenis,
            tingkat:tingkat,
            nama_prestasi:nama_prestasi,
            tahun:tahun,
            penyelenggara:penyelenggara,
        }, success:function(response){
            loadPrestasi();
            $("#btnSavePrestasi").show();
            $("#btnLoadingPrestasi").hide();
            $("#formPrestasi")[0].reset();

            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }, error:function(response){
            loadPrestasi();
            $("#btnSavePrestasi").show();
            $("#btnLoadingPrestasi").hide();

            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan!',
            });
        }
    });
}
function deletePrestasi(id)
{
    var url = "/ppdb/prestasi/delete";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idprestasi:id,
        },success:function(response){
            loadPrestasi();
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: response.success,
            });
        },error:function(response){
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan!',
            });
        }
    });
}



/**Beasiswa */
function loadBeasiswa()
{
    var url = "/ppdb/beasiswa/table";
    $("#tableBeasiswa").load(url);
}

function saveBeasiswa()
{
    $("#btnSaveBeasiswa").hide();
    $("#btnLoadingBeasiswa").show();

    var url = "/ppdb/beasiswa";
    var jenis = $("#jenis").val();
    var keterangan = $("#keterangan").val();
    var tahun_mulai = $("#tahun_mulai").val();
    var tahun_selesai = $("#tahun_selesai").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            jenis:jenis,
            keterangan:keterangan,
            tahun_mulai:tahun_mulai,
            tahun_selesai:tahun_selesai,
        },success:function(response){
            loadBeasiswa();
            $("#btnSaveBeasiswa").show();
            $("#btnLoadingBeasiswa").hide();
            $("#formBeasiswa")[0].reset();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        },error:function(response){
            loadBeasiswa();
            $("#btnSaveBeasiswa").show();
            $("#btnLoadingBeasiswa").hide();
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan penginputan!',
            });
        }
    });
}
function deleteBeasiswa(id)
{
    var url = "/ppdb/beasiswa/delete";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idss:id,
        },success:function(response){
            loadBeasiswa();
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: response.success,
            });
        },error:function(response){
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan penginputan!',
            });
        }
    });
}

/**Kesajahteraan as Kes */
function loadKes()
{
    var url = "/ppdb/kesejahteraan/table";
    $("#tableKes").load(url);
}
function saveKes()
{
    $("#btnSaveKes").hide();
    $("#btnLoadingKes").show();

    var url = "/ppdb/kesejahteraan";
    var jenis = $("#jenis").val();
    var nama = $("#nama").val();
    var nomor_kartu = $("#nomor_kartu").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            jenis:jenis,
            nama:nama,
            nomor_kartu:nomor_kartu,
        },success:function(response){
            $("#btnSaveKes").show();
            $("#btnLoadingKes").hide();
            loadKes();
            $("#formKes")[0].reset();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }, error:function(){
            $("#btnSaveKes").show();
            $("#btnLoadingKes").hide();
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan!',
            });
        }
    });
}
function deleteKes(id)
{
    var url = "/ppdb/kesejahteraan/delete";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idks:id,
        },success:function(response){
            loadKes();
            Swal.fire({
                icon : 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }, error:function(){
            Swal.fire({
                icon : 'warning',
                title: 'Oops...',
                text: 'Terjadi kesalahan!',
            });
        }
    });
}

/**Jarak Rumah */
function AutoJarak()
{
    $("#jarak").val(0);
    $("#jarak").attr('readonly', true);
}
function AutoJarakReset()
{
    $("#jarak").val("");
    $("#jarak").attr('readonly', false);
}