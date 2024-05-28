$(document).ready(function(){
    $.ajaxSetup({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        // }
    });
    console.log('ready');

    //load data
    loadAll();

    //Hide btn animasi
    $("#btn-loadUpload").hide();
    $("#btn-loading-informasi").hide();
    $("#btn-loading-biodata").hide();
    $("#btn-loading-alamat").hide();
    $("#btn-loading-priodik").hide();
    $("#btn-loading-registrasi").hide();
    $("#btn-loading-ayah").hide();
    $("#btn-loading-ibu").hide();
    $("#btn-loading-wali").hide();
    $("#btn-loading-biodata").hide();
});

function loadAll()
{
    loadDetail();
    load();
    loadPriodik();
    loadRegister();
    loadAyah();
    loadIbu();
    loadWali();
}

function load()
{
    var id = $("#user_id").val();
    var url = '/siswa/' + id + '/load';
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            console.log('loaded');
            //Informasi Siswa
            $("#nisn").val(data.nisn);
            $("#first_name").val(data.first_name);
            $("#gender").val(data.gender);
            $("#tempat_lahir").val(data.tempat_lahir);
            $("#tanggal_lahir").val(data.tanggal_lahir);
            $("#kelas").val(data.kelas);
            $("#phone").val(data.phone);
            $("#email").val(data.email);
            $("#telephone").val(data.telephone)

            //Biodata Siswa
            $("#kk").val(data.kk);
            $("#nik").val(data.nik);
            $("#akta_lahir").val(data.akta_lahir);
            $("#agama").val(data.agama);
            
            $("#no_kks").val(data.no_kks)
            $("#penerima_kip").val(data.penerima_kip)
            $("#no_kip").val(data.no_kip)
            $("#nama_kip").val(data.nama_kip)
            $("#alasan_menolak_kip").val(data.alasan_menolak_kip)
            $("#penerima_kps").val(data.penerima_kps)
            $("#nomor_kps").val(data.nomor_kps)
            $("#alasan_layak_pip").val(data.alasan_layak_pip)
            $("#penerima_kip").val(data.penerima_kip);
            $("#nama_kip").val(data.nama_kip);

        }
    });
}

function loadPriodik()
{
    var id = $("#user_id").val();
    var url = "/priodik/" + id + "/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(priodik){
            $("#tinggi").val(priodik.tinggi);
            $("#berat").val(priodik.berat);
            $("#lingkar_kepala").val(priodik.lingkar_kepala);
            $("#jarak_per_1km").val(priodik.jarak_per_1km);
            $("#jarak").val(priodik.jarak);
            $("#jam").val(priodik.jam);
            $("#menit").val(priodik.menit);
            $("#saudara").val(priodik.saudara);
        }
    });
}

function loadRegister()
{
    var id = $("#user_id").val();
    var url = "/register/" + id + "/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(register){
            $("#kompetensi").val(register.kompetensi);
            $("#jenis").val(register.jenis);
            $("#nis").val(register.nis);
            $("#tanggal_masuk").val(register.tanggal_masuk);
            $("#sekolah_asal").val(register.sekolah_asal);
            $("#nomor_ujian").val(register.nomor_ujian);
            $("#nomor_ijazah").val(register.nomor_ijazah);
            $("#nomor_skhu").val(register.nomor_skhu);
        }
    });
}

function loadAyah()
{
    var id = $("#user_id").val();
    var url = "/ayah/" + id + "/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(ayah){
            $("#ayahNama").val(ayah.nama_lengkap);
            $("#ayahNik").val(ayah.nik);
            $("#ayahTahunLahir").val(ayah.tahun_lahir);
            $("#ayahPendidikan").val(ayah.pendidikan);
            $("#ayahPekerjaan").val(ayah.pekerjaan);
            $("#ayahPenghasilan").val(ayah.penghasilan);
        }
    });
}

function loadIbu()
{
    var id = $("#user_id").val();
    var url = "/ibu/" + id + "/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(ibu){
            $("#ibuNama").val(ibu.nama_lengkap);
            $("#ibuNik").val(ibu.nik);
            $("#ibuTahunLahir").val(ibu.tahun_lahir);
            $("#ibuPendidikan").val(ibu.pendidikan);
            $("#ibuPekerjaan").val(ibu.pekerjaan);
            $("#ibuPenghasilan").val(ibu.penghasilan);
        }
    });
}

function loadWali()
{
    var id = $("#user_id").val();
    var url = "/wali/" + id + "/json";

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(wali){
            $("#waliNama").val(wali.nama_lengkap);
            $("#waliNik").val(wali.nik);
            $("#waliTahunLahir").val(wali.tahun_lahir);
            $("#waliPendidikan").val(wali.pendidikan);
            $("#waliPekerjaan").val(wali.pekerjaan);
            $("#waliPenghasilan").val(wali.penghasilan);
        }
    });
}

function loadDetail()
{
    var id = $("#user_id").val();
    var url = '/siswa/' + id + '/detail';
    $("#detail-siswa").load(url);
    console.log('loaded');
}

function editInformasi()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-loading-informasi").show();
    $("#btn-loading-biodata").show();
    $("#btn-edit-biodata").hide();
    $("#btn-edit-informasi").hide();
    
    var url = "/siswa/updateInformasi";

    var id          = $("#user_id").val();
    var first_name  = $("#first_name").val();
    var email       = $("#email").val();
    var phone       = $("#phone").val();
    var telephone   = $("#telephone").val();
    var kelas       = $("#kelas").val();

    var nisn                = $("#nisn").val();
    var gender              = $("#gender").val();
    var tempat_lahir        = $("#tempat_lahir").val();
    var tanggal_lahir       = $("#tanggal_lahir").val();
    
    var nik                 = $("#nik").val();
    var kk                  = $("#kk").val();
    var akta_lahir          = $("#akta_lahir").val();
    var agama               = $("#agama").val();

    var no_kks              = $("#no_kks").val()
    var penerima_kip        = $("#penerima_kip").val()
    var no_kip              = $("#no_kip").val()
    var nama_kip            = $("#nama_kip").val()
    var alasan_menolak_kip  = $("#alasan_menolak_kip").val()
    var penerima_kps        = $("#penerima_kps").val()
    var nomor_kps           = $("#nomor_kps").val()
    var penerima_kps        = $("#penerima_kps").val()
    var alasan_layak_pip    = $("#alasan_layak_pip").val()


    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            first_name:first_name,
            email:email,
            phone:phone,
            telephone:telephone,
            kelas:kelas,
            nisn:nisn,
            gender:gender,
            tempat_lahir:tempat_lahir,
            tanggal_lahir:tanggal_lahir,
            nik:nik,
            kk:kk,
            akta_lahir:akta_lahir,
            agama:agama,
            no_kks:no_kks,
            penerima_kip:penerima_kip,
            no_kip:no_kip,
            nama_kip:nama_kip,
            alasan_menolak_kip:alasan_menolak_kip,
            penerima_kps:penerima_kps,
            nomor_kps:nomor_kps,
            alasan_layak_pip:alasan_layak_pip,
        }, success : function(response){
            $("#btn-loading-informasi").hide();
            $("#btn-loading-biodata").hide();
            $("#btn-edit-biodata").show();
            $("#btn-edit-informasi").show();
            loadAll();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: response.success,
            });
        }, error : function(){
            $("#btn-loading-informasi").hide();
            $("#btn-loading-biodata").hide();
            $("#btn-edit-biodata").show();
            $("#btn-edit-informasi").show();
            loadAll();
            Swal.fire({
                icon:'warning',
                title:'Oops..',
                text: 'Terjadi kesalahan!',
            });
        }
    });

}

function updatePriodik()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Animasi Loading...
    $("#btn-edit-priodik").hide();
    $("#btn-loading-priodik").show();

    var url = "/priodik/update";
    var id = $("#user_id").val();
    var tinggi = $("#tinggi").val();
    var berat = $("#berat").val();
    var lingkar_kepala = $("#lingkar_kepala").val();
    var jarak_per_1km = $("#jarak_per_1km").val();
    var jarak  = $("#jarak").val();
    var jam = $("#jam").val();
    var menit = $("#menit").val();
    var saudara = $("#saudara").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            tinggi:tinggi,
            berat:berat,
            lingkar_kepala:lingkar_kepala,
            jarak_per_1km:jarak_per_1km,
            jarak:jarak,
            jam:jam,
            menit:menit,
            saudara:saudara,
        }, success:function(response){
            //Animasi Loading...
            $("#btn-edit-priodik").show();
            $("#btn-loading-priodik").hide();
            Swal.fire({
                icon:'success',
                title:'Congrats..',
                text: response.success,
            });
        }, error:function(){
            //Animasi Loading...
            $("#btn-edit-priodik").show();
            $("#btn-loading-priodik").hide();
            Swal.fire({
                icon:'warning',
                title:'Oops..',
                text: 'Terjadi kesalahan.',
            });
        }
    });

}

function updateAlamat()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Animasi Loading...
    $("#btn-edit-alamat").hide();
    $("#btn-loading-alamat").show();

    var url = "/alamat/update";
    var id = $("#user_id").val();
    var provinsi = $("#daPro").val();
    var idprovinsi = $("#idprovinsi").val();
    var kota = $("#daKab").val();
    var idkota = $("#kabupaten").val();
    var kec  = $("#daKec").val();
    var idkec = $("#kecamatan").val();
    var kel = $("#daKel").val();
    var idkel = $("#keluarahan").val();
    var rt = $("#rt").val();
    var rw = $("#rw").val();
    var kode_pos = $("#kode_pos").val();
    var jalan = $("#jalan").val();
    var status_tempat_tinggal = $("#status_tempat_tinggal").val();
    var moda_transportasi = $("#moda_transportasi").val();
    var lintang = $("#lintang").val();
    var bujur = $("#bujur").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            daPro:provinsi,
            idprovinsi:idprovinsi,
            daKab:kota,
            idkota:idkota,
            daKec:kec,
            idkec:idkec,
            daKel:kel,
            idkel:idkel,
            rt:rt,
            rw:rw,
            kode_pos:kode_pos,
            jalan:jalan,
            status_tempat_tinggal:status_tempat_tinggal,
            moda_transportasi:moda_transportasi,
            lintang:lintang,
            bujur:bujur,
        }, success:function(response){
            //Animasi Loading...
            $("#btn-edit-alamat").show();
            $("#btn-loading-alamat").hide();
            Swal.fire({
                icon:'success',
                title:'Congrats..',
                text:response.success,
            });
        }, error:function(){
            //Animasi Loading...
            $("#btn-edit-alamat").show();
            $("#btn-loading-alamat").hide();
            Swal.fire({
                icon:'warning',
                title:'Oops..',
                text:'Terjadi kesalahan.',
            });
        }
    });
}

function updateRegistrasi()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Animasi Loading...
    $("#btn-edit-registrasi").hide();
    $("#btn-loading-registrasi").show();

    var url = "/registrasi/update";
    var id = $("#user_id").val();
    var kompetensi = $("#kompetensi").val();
    var jenis = $("#jenis").val();
    var nis = $("#nis").val();
    var tanggal_masuk = $("#tanggal_masuk").val();
    var sekolah_asal = $("#sekolah_asal").val();
    var nomor_ujian = $("#nomor_ujian").val();
    var nomor_ijazah = $("#nomor_ijazah").val();
    var nomor_skhu = $("#nomor_skhu").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            kompetensi:kompetensi,
            jenis:jenis,
            nis:nis,
            tanggal_masuk:tanggal_masuk,
            sekolah_asal:sekolah_asal,
            nomor_ijazah:nomor_ijazah,
            nomor_ujian:nomor_ujian,
            nomor_skhu:nomor_skhu,
        }, success:function(response){
            //Animasi Loading...
            $("#btn-edit-registrasi").show();
            $("#btn-loading-registrasi").hide();
            Swal.fire({
                icon:'success',
                title:'Congrats..',
                text:response.success,
            });
        }, error:function(){
            //Animasi Loading...
            $("#btn-edit-registrasi").show();
            $("#btn-loading-registrasi").hide();
            Swal.fire({
                icon:'success',
                title:'Congrats..',
                text:response.success,
            });
        }
    });
}

function updateAyah()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Animasi
    $("#btn-edit-ayah").hide();
    $("#btn-loading-ayah").show();

    var id = $("#user_id").val();
    var url = "/ayah/update";
    var nama = $("#ayahNama").val();
    var nik = $("#ayahNik").val();
    var tahun_lahir = $("#ayahTahunLahir").val();
    var pendidikan = $("#ayahPendidikan").val();
    var pekerjaan = $("#ayahPekerjaan").val();
    var penghasilan = $("#ayahPenghasilan").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            nama:nama,
            nik:nik,
            tahun_lahir:tahun_lahir,
            pendidikan:pendidikan,
            pekerjaan:pekerjaan,
            penghasilan:penghasilan,
        }, success:function(response){
            //Animasi
            $("#btn-edit-ayah").show();
            $("#btn-loading-ayah").hide();
            loadAll();
            Swal.fire({
                icon:'success',
                title:'Congrats...',
                text:response.success,
            });
        }, error:function(){
            //Animasi
            $("#btn-edit-ayah").show();
            $("#btn-loading-ayah").hide();
            loadAll();
            Swal.fire({
                icon:'warning',
                title:'Oops...',
                text:'Terjadi kesalahan',
            });
        }
    });
}

function updateIbu()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //Animasi
    $("#btn-edit-ibu").hide();
    $("#btn-loading-ibu").show();

    var id = $("#user_id").val();
    var url = "/ibu/update";
    var nama = $("#ibuNama").val();
    var nik = $("#ibuNik").val();
    var tahun_lahir = $("#ibuTahunLahir").val();
    var pendidikan = $("#ibuPendidikan").val();
    var pekerjaan = $("#ibuPekerjaan").val();
    var penghasilan = $("#ibuPenghasilan").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            nama:nama,
            nik:nik,
            tahun_lahir:tahun_lahir,
            pendidikan:pendidikan,
            pekerjaan:pekerjaan,
            penghasilan:penghasilan,
        }, success:function(response){
            //Animasi
            $("#btn-edit-ibu").show();
            $("#btn-loading-ibu").hide();
            loadAll();
            Swal.fire({
                icon:'success',
                title:'Congrats...',
                text:response.success,
            });
        }, error:function(){
            //Animasi
            $("#btn-edit-ibu").show();
            $("#btn-loading-ibu").hide();
            loadAll();
            Swal.fire({
                icon:'warning',
                title:'Oops...',
                text:'Terjadi kesalahan',
            });
        }
    });
}

function updateWali()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //Animasi
    $("#btn-edit-wali").hide();
    $("#btn-loading-wali").show();

    var id = $("#user_id").val();
    var url = "/wali/update";
    var nama = $("#waliNama").val();
    var nik = $("#waliNik").val();
    var tahun_lahir = $("#waliTahunLahir").val();
    var pendidikan = $("#waliPendidikan").val();
    var pekerjaan = $("#waliPekerjaan").val();
    var penghasilan = $("#waliPenghasilan").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            nama:nama,
            nik:nik,
            tahun_lahir:tahun_lahir,
            pendidikan:pendidikan,
            pekerjaan:pekerjaan,
            penghasilan:penghasilan,
        }, success:function(response){
            //Animasi
            $("#btn-edit-wali").show();
            $("#btn-loading-wali").hide();
            loadAll();
            Swal.fire({
                icon:'success',
                title:'Congrats...',
                text:response.success,
            });
        }, error:function(){
            //Animasi
            $("#btn-edit-wali").show();
            $("#btn-loading-wali").hide();
            loadAll();
            Swal.fire({
                icon:'warning',
                title:'Oops...',
                text:'Terjadi kesalahan',
            });
        }
    });
}


function editDetail2()
{
    // loading Animasi
    $("#btn-edit-detail2").hide();
    $("#btn-loadDetail2").show();
    
    var url = "/siswa/update2";
    var id = $("#user_id").val();
    var kelas = $("#kelas").val();
    var phone = $("#phone").val();
    var email = $("#email").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            kelas:kelas,
            phone:phone,
            email:email,
        }, success : function(response){
            //Loading Animation
            $("#btn-edit-detail2").show();
            $("#btn-loadDetail2").hide();

            //load data
            loadDetail();
            load();
            console.log('changed');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Data kontak berhasil diupdate!',
            });
        }
    });
}

function editDetail3()
{
    //Loading Animation
    $("#btn-edit-detail3").hide();
    $("#btn-loadDetail3").show();

    var url = "/siswa/update3";
    var id = $("#user_id").val();
    var nama_wali = $("#nama_wali").val();
    var kontak_wali = $("#kontak_wali").val();
    var pekerjaan_wali = $("#pekerjaan_wali").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            id:id,
            nama_wali:nama_wali,
            kontak_wali:kontak_wali,
            pekerjaan_wali:pekerjaan_wali,
        }, success : function(response){
            //Loading Animation
            $("#btn-edit-detail3").show();
            $("#btn-loadDetail3").hide();

            //load data
            loadDetail();
            load();
            console.log('changed');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Data Orang Tua berhasil diupdate!',
            });
        }
    });

}

function changeImage()
{
    //Loading Animation
    $("#inputGroupFileAddon04").hide();
    $("#btn-loadUpload").show();

    var form = $("#photoForm")[0];
    var data = new FormData(form);
    var url = "/siswa/change_image";
    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            
            //Loading Animation
            $("#inputGroupFileAddon04").show();
            $("#btn-loadUpload").hide();

            //load data
            loadDetail();
            load();
            console.log('changed');
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Image Has changed!',
            });
        }
    });
}

// function SaveSiswa()
// {
//     $("#btn-store-siswa").attr('disabled', true)
//     $("#btn-store-siswa").html('Save Changes <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>')
// }

$("#btn-store-siswa").click(function(){
    $("#btn-store-siswa").attr('disabled', true)
    $("#btn-store-siswa").html('Save Changes <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>')
});

/**Delete Siswa */
function modaldeleteSiswa(id)
{
    console.log(id)
    $("#idDeleteSiswa").val(id)
    $("#modalDeleteSiswa").modal('show')
}

function deleteSiswa()
{
    $("#btnDeleteSiswa").attr('disabled', true)
    $("#btnDeleteSiswa").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Hapus')
    var url = "/siswa/delete";
    var id = $("#idDeleteSiswa").val();

    $.ajax({
        url:url,
        type:'POST',
        cahce:false,
        data:{
            id:id,
        },
        success:function(response){
            if(response.status == 500){
                /**Notifikasi */
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Request Timeout',
                });
            }else if(response.status == 200){
                // Menampilkan notifikasi SweetAlert sebelum redirect
                Swal.fire({
                    icon: 'warning',
                    title: 'Congrats!',
                    text: response.message,
                }).then((result) => {
                    // Redirect ke halaman siswa setelah notifikasi ditutup
                    if (result.isConfirmed) {
                        window.location = "/siswa";
                    }
                });
            }
        },
        error:function(){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Request Timeout',
            });
        }
    });
}