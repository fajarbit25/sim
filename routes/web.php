<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PaymentControlller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\TkController;
use App\Http\Controllers\TracertStudyController;
use App\Http\Controllers\RaportSdController;
use App\Http\Controllers\RaportController;

Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');
});

/**PPDB Route */
Route::controller(PpdbController::class)->group(function(){
    Route::get('/tkit/ppdb', 'tkit_ppdb')->name('tkit');
    Route::get('/sdit/ppdb', 'sdit_ppdb')->name('sdit_ppdb');
    Route::get('/smpit/ppdb', 'smpit_ppdb')->name('smpit_ppdb');

    /**SMKIT */
    Route::get('/smkit/ppdb', 'smkit_ppdb')->name('smkit_ppdb');
    Route::post('/smkit/ppdb', 'store')->name('smkit_ppdb.store');

    /** Halaman Pembayaran */
    Route::get('/ppdb', 'ppdb')->name('ppdb')->middleware('auth');
    Route::post('/ppdb/payment_confirm', 'payment')->middleware('auth')->name('ppdb.payment');

    Route::get('/ppdb/upload_dokument', 'upload')->middleware('auth')->name('ppdb.upload');
    Route::get('/ppdb/biodata', 'biodata')->middleware('auth')->name('ppdb.biodata');
    Route::get('/ppdb/alamat', 'alamat')->middleware('auth')->name('ppdb.alamat');
    Route::post('/ppdb/alamat', 'store_alamat')->middleware('auth')->name('ppdb.store_alamat');
    Route::get('/ppdb/ayah', 'ayah')->middleware('auth')->name('ppdb.ayah');
    Route::post('/ppdb/wali', 'store_wali')->middleware('auth')->name('ppdb.store_wali');
    Route::get('/ppdb/ibu', 'ibu')->middleware('auth')->name('ppdb.ibu');
    Route::get('/ppdb/wali', 'wali')->middleware('auth')->name('ppdb.wali');
    Route::get('/ppdb/kontak', 'kontak')->middleware('auth')->name('ppdb.kontak');
    Route::get('/ppdb/priodik', 'priodik')->middleware('auth')->name('ppdb.priodik');
    Route::post('/ppdb/priodik', 'store_priodik')->middleware('auth')->name('ppdb.store_priodik');

    Route::get('/ppdb/prestasi', 'prestasi')->middleware('auth')->name('ppdb.prestasi');
    Route::post('/ppdb/prestasi', 'store_prestasi')->middleware('auth')->name('ppdb.store_prestasi');
    Route::get('/ppdb/prestasi/table', 'table_prestasi')->middleware('auth')->name('ppdb.table_prestasi');
    Route::post('/ppdb/prestasi/delete', 'delete_prestasi')->middleware('auth')->name('ppdb.delete_prestasi');

    Route::get('/ppdb/kesejahteraan', 'kesejahteraan')->middleware('auth')->name('ppdb.kesejahteraan');
    Route::post('/ppdb/kesejahteraan', 'store_kesejahteraan')->middleware('auth')->name('ppdb.store_kesejahteraan');
    Route::get('/ppdb/kesejahteraan/table', 'table_kesejahteraan')->middleware('auth')->name('ppdb.table_kesejahteraan');
    Route::post('/ppdb/kesejahteraan/delete', 'delete_kesejahteraan')->middleware('auth')->name('ppdb.delete_kesejahteraan');

    Route::get('/ppdb/beasiswa', 'beasiswa')->middleware('auth')->name('ppdb.beasiswa');
    Route::post('/ppdb/beasiswa', 'store_beasiswa')->middleware('auth')->name('ppdb.store_beasiswa');
    Route::get('/ppdb/beasiswa/table', 'table_beasiswa')->middleware('auth')->name('ppdb.table_beasiswa');
    Route::post('/ppdb/beasiswa/delete', 'delete_beasiswa')->middleware('auth')->name('ppdb.delete_beasiswa');

    Route::get('/ppdb/registrasi', 'registrasi')->middleware('auth')->name('ppdb.registrasi');
    Route::post('/ppdb/registrasi', 'store_registrasi')->middleware('auth')->name('ppdb.store_registrasi');
    
    Route::get('/ppdb/selesai', 'finish')->middleware('auth')->name('ppdb.finish');

    Route::post('/ppdb/kontak', 'store_kontak')->middleware('auth')->name('ppdb.store_kontak');
    Route::get('/ppdb/question', 'question')->middleware('auth')->name('ppdb.question');
    Route::get('/ppdb/pernyataan', 'pernyataan')->middleware('auth')->name('ppdb.pernyataan');


    /**Upload Document */
    Route::get('/ppdb/upload/doc/form', 'form_upload')->middleware('auth')->name('form_upload');
    Route::post('/akta_lahir', 'upload_akta_lahir')->middleware('auth')->name('upload_akta_lahir');
    Route::post('/kartu_keluarga', 'upload_kk')->middleware('auth')->name('upload_kk');
    Route::post('/ktp_ortu', 'ktp_ortu')->middleware('auth')->name('ktp_ortu');
    Route::post('/pas_foto', 'pas_foto')->middleware('auth')->name('pas_foto');
    Route::post('/ppdb/delete_document', 'delete_document')->middleware('auth')->name('delete_document');
    Route::get('/ppdb/get_fileCount', 'get_fileCount')->middleware('auth')->name('get_fileCount');

    Route::get('/ppdb/form_keb_khusus/{any}/show', 'form_keb_khusus')->middleware('auth')->name('form_keb_khusus');
    Route::get('/ppdb/form_keb_khusus_wali/{any}/show', 'form_keb_khusus_wali')->middleware('auth')->name('form_keb_khusus_wali');
    Route::post('/ppdb/add_keb_khusus', 'add_keb_khusus')->middleware('auth')->name('add_keb_khusus');
    Route::post('/ppdb/del_keb_khusus', 'del_keb_khusus')->middleware('auth')->name('del_keb_khusus');
    Route::post('/ppdb/submit_biodata', 'submit_biodata')->middleware('auth')->name('submit_biodata');

    /** Json Alamat */
    Route::get('/alamat/{id}/json', 'json_alamat')->middleware('auth')->name('json_alamat');

    Route::get('/validate/{id}/data_validation', 'data_validation')->middleware('auth')->name('ppdb.data_validation');

});


Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->middleware('guest')->name('login');
    Route::get('/register', 'register')->middleware('guest')->name('register');
    Route::post('/register', 'store')->middleware('guest')->name('user.store');
});

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->middleware('auth')->name('dashboard');
    Route::get('dashboard/tahfidz', 'tahfidz')->middleware('auth')->name('dashboard.tahfidz');
    Route::get('/dashboard/activity', 'activity')->middleware('auth')->name('absen.activity');
    Route::get('/dashboard/{id}/activity/searchKelas', 'activitySearchKelas')->middleware('auth')->name('absen.activitySearchKelas');
    Route::get('/dashboard/{id}/activity/searchGuru', 'activitySearchGuru')->middleware('auth')->name('absen.activitySearchGuru');

    /**Manage Profile */
    Route::get('/profile', 'profile')->middleware('auth')->name('profile');
    Route::get('/profile/akun', 'profile_akun')->middleware('auth')->name('profile.akun');
    Route::post('/profile/akun', 'updateProfile')->middleware('auth')->name('profile.update');
    Route::get('/profile/image', 'profile_image')->middleware('auth')->name('profile.image');
    Route::post('/profile/change_image', 'change_image')->middleware('auth')->name('profile.change_image');
    Route::post('/profle/change/password', 'change_password')->middleware('auth')->name('profile.change_password');
    

    /**Manage Profile Siswa */
    Route::get('/siswa/profile', 'profile_siswa')->middleware('auth')->name('profile.siswa');
    Route::get('/siswa/profile/akun', 'profile_siswa_akun')->middleware('auth')->name('profile.siswa_akun');
    Route::post('/profile/updateTeacherAddressProvice', 'updateTeacherAddressProvice')->middleware('auth')->name('profile.updateTeacherAddressProvice');
    Route::post('/profile/updateTeacherAddressCity', 'updateTeacherAddressCity')->middleware('auth')->name('profile.updateTeacherAddressCity');
    Route::post('/profile/updateTeacherAddressDistricts', 'updateTeacherAddressDistricts')->middleware('auth')->name('profile.updateTeacherAddressDistricts');
    Route::post('/profile/updateTeacherAddressVillages', 'updateTeacherAddressVillages')->middleware('auth')->name('profile.updateTeacherAddressVillages');
});


Route::controller(NewsController::class)->group(function(){
    Route::get('/berita', 'index')->middleware('auth')->name('berita');
    Route::get('/berita/{id}/edit', 'edit_berita')->middleware('auth')->name('berita.edit_berita');
    Route::get('/addNews', 'addNews')->middleware('auth')->name('addNews');
    Route::post('/news', 'update')->middleware('auth')->name('news');
    Route::post('/news/posts', 'posts')->middleware('auth')->name('news.posts');
    Route::post('/news/takeDown', 'takeDown')->middleware('auth')->name('news.takeDown');
    Route::post('/news/edit', 'edit')->middleware('auth')->name('news.edit');
    Route::get('/news/loadValue', 'loadValue')->middleware('auth')->name('loadValue');
    Route::get('/news/{id}/loadValue', 'loadValue_edit')->middleware('auth')->name('loadValue_edit');
    Route::get('/news/loadImage', 'loadImage')->middleware('auth')->name('loadImage');
    Route::get('/news/{id}/loadImageEdit', 'loadImageEdit')->middleware('auth')->name('loadImageEdit');
    Route::post('/news/uploadImage', 'uploadImage')->middleware('auth')->name('uploadImage');
    Route::post('/news/uploadImageNew', 'uploadImageNew')->middleware('auth')->name('uploadImageNew');
    Route::get('/banner', 'update_banner')->middleware('auth')->name('banner');
    Route::post('/store_banner', 'store_banner')->middleware('auth')->name('store_banner');
    Route::get('/bannerCarousel', 'bannerCarousel')->middleware('auth')->name('bannerCarousel');
    Route::get('/tableBanner', 'tableBanner')->middleware('auth')->name('tableBanner');
    Route::post('/deleteBanner', 'deleteBanner')->middleware('auth')->name('deleteBanner');

    /**Manage Our Team */
    Route::get('/tim', 'tim')->middleware('auth')->name('team');
    Route::get('/tim/add', 'tim_add')->middleware('auth')->name('team.add');
    Route::get('/tim/{id}/edit', 'tim_edit')->middleware('auth')->name('team.edit');
    Route::get('/tim/{id}/foto', 'tim_foto')->middleware('auth')->name('team.foto');
    Route::post('/tim/add', 'tim_add_store')->middleware('auth')->name('team.add_store');
    Route::post('/tim/update', 'tim_update')->middleware('auth')->name('team.update');
    Route::post('/tim/delete', 'tim_destroy')->middleware('auth')->name('team.delete');
    Route::post('/tim/update/foto', 'tim_update_foto')->middleware('auth')->name('team.tim_update_foto');
});


Route::controller(RoomController::class)->group(function(){ 
    Route::get('/kelas', 'index')->middleware('auth')->name('kelas');
    Route::post('/kelas', 'store')->middleware('auth')->name('kelas.store');
    Route::get('/kelas/load_tabel', 'laod_tabel')->middleware('auth')->name('kelas.load_tabel');
    Route::get('kelas/{id}/edit', 'edit')->middleware('auth')->name('kelas.edit');
    Route::post('/kelas/update', 'update')->middleware('auth')->name('kelas.update');
    Route::get('/kelas/{any}/search', 'search')->middleware('auth')->name('kelas.search');
    Route::get('/kelas/{id}/siswa', 'kelas_siswa')->middleware('auth')->name('kelas.siswa');
    Route::get('/kelas/siswaUnAlocated', 'siswaUnAlocated')->middleware('auth')->name('kelas.siswaUnAlocated');
    Route::get('/kelas/{id}/siswaAlocated', 'siswaAlocated')->middleware('auth')->name('kelas.siswaAlocated');
    Route::post('/kelas/siswa/add', 'addSiswa')->middleware('auth')->name('kelas.addSiswa');
    Route::post('/kelas/siswa/return', 'returnSiswa')->middleware('auth')->name('kelas.returnSiswa');

    Route::get('/kelas/jumlah-siswa/json', 'studentCount')->middleware('auth')->name('kelas.studentCount');
    Route::get('/kelas/{id}/previewNaikKelas', 'previewNaikKelas')->middleware('auth')->name('kelas.previewNaikKelas');
    Route::get('/kelas/{id}/naikKelasTujuan', 'naikKelasTujuan')->middleware('auth')->name('kelas.naikKelasTujuan');
    Route::post('/kelas/naikKelas/process', 'naikKelasProcess')->middleware('auth')->name('kelas.naikKelasProcess');
});

Route::get('/level', [LevelController::class, 'index'])->middleware('auth')->name('level');
Route::post('/level', [LevelController::class, 'store'])->middleware('auth')->name('store.level');
Route::get('/level/table', [LevelController::class, 'table'])->middleware('auth')->name('table.level');

Route::controller(GuruController::class)->group(function(){
    Route::get('/guru', 'index')->name('guru')->middleware('auth');
    Route::post('/guru', 'store')->name('store.guru')->middleware('auth');
    Route::post('/guru/delete', 'destroy')->name('guru.destroy')->middleware('auth');
    Route::get('/guru/{id}/show', 'show')->name('guru.show')->middleware('auth');
    Route::get('/guru/{id}/foto', 'loadFoto')->name('guru.foto')->middleware('auth');
    Route::get('/guru/{id}/detail', 'detail')->name('guru.detail')->middleware('auth');
    Route::get('/single/{id}/show', 'single')->name('single')->middleware('auth');
    Route::post('/guru/change_image', 'changeImage')->name('changeImage')->middleware('auth');
    Route::post('/guru/update', 'update')->name('guru.update')->middleware('auth');
    
    /**Ajax URL */
    Route::get('/guru/{id}/tabelMapel', 'tableMapel')->middleware('auth')->name('guru.tableMapel');
    Route::post('/guru/mapel/add', 'addMapel')->middleware('auth')->name('guru.addMapel');
    Route::post('/guru/mapel/delete', 'deleteMapel')->middleware('auth')->name('guru.deleteMapel');
});


Route::controller(SiswaController::class)->group(function(){
    Route::get('/siswa', 'index')->name('siswa')->middleware('auth');
    Route::post('/siswa', 'store')->name('siswa.store')->middleware('auth');
    Route::post('/siswa/updateInformasi', 'updateInformasi')->name('siswa.updateInformasi')->middleware('auth');
    Route::post('/siswa/update2', 'update2')->name('siswa.update2')->middleware('auth');
    Route::post('/siswa/update3', 'update3')->name('siswa.update3')->middleware('auth');
    Route::post('/siswa/delete', 'destroy')->name('siswa.delete')->middleware('auth');
    Route::get('/siswa/{id}/show', 'show')->name('siswa.show')->middleware('auth');
    Route::get('/siswa/{id}/detail', 'detail')->name('siswa.detail')->middleware('auth');
    Route::get('/siswa/{id}/load', 'load')->name('siswa.load')->middleware('auth');
    Route::post('siswa/change_image', 'changeImage')->name('siswa.changeImage')->middleware('auth');
    Route::get('/siswa/{id}/informasi', 'informasi')->name('siswa.informasi')->middleware('auth');

    /**update v.1 */
    Route::get('/priodik/{id}/json', 'priodik_json')->name('priodik.json')->middleware('auth');
    Route::get('/register/{id}/json', 'register_json')->name('register.json')->middleware('auth');
    Route::get('/ayah/{id}/json', 'ayah_json')->name('ayah.json')->middleware('auth');
    Route::get('/ibu/{id}/json', 'ibu_json')->name('ibu.json')->middleware('auth');
    Route::get('/wali/{id}/json', 'wali_json')->name('wali.json')->middleware('auth');
    Route::post('/priodik/update', 'updatePriodik')->middleware('auth')->name('priodik.update');
    Route::post('/alamat/update', 'updateAlamat')->middleware('auth')->name('alamat.update');
    Route::post('/registrasi/update', 'updateRegistrasi')->middleware('auth')->name('registrasi.update');
    Route::post('/ayah/update', 'updateAyah')->middleware('auth')->name('ayah.update');
    Route::post('/ibu/update', 'updateIbu')->middleware('auth')->name('ibu.update');
    Route::post('/wali/update', 'updateWali')->middleware('auth')->name('wali.update');

    /**Api alamat */
    Route::get('/api/province', 'getApiProvinsi')->middleware('auth')->name('api.province');
    Route::get('/api/{id}/province', 'getApiProvinceSingle')->middleware('auth')->name('api.provinceSingle');
    Route::get('/api/{id}/regencies', 'getApiRegencies')->middleware('auth')->name('api.regencies');
    Route::get('/api/{id}/regency', 'getApiRegencySingle')->middleware('auth')->name('api.regency');
    Route::get('/api/{id}/districts', 'getApiDistricts')->middleware('auth')->name('api.districts');
    Route::get('/api/{id}/district', 'getApiDistrictSingle')->middleware('auth')->name('api.district');
    Route::get('/api/{id}/villages', 'getApiVillages')->middleware('auth')->name('api.villages');
    Route::get('/api/{id}/village', 'getApiVillageSingle')->middleware('auth')->name('api.village');

    /**Import Excel */
    Route::get('/siswa/import', 'importSiswa')->middleware('auth')->name('siswa.import');
    Route::post('/siswa/import', 'importSiswaProses')->middleware('auth')->name('siswa.import');


});

Route::controller(TracertStudyController::class)->group(function(){
    Route::get('/siswa/tracert-study', 'index')->middleware('auth')->name('tStudy.index');
});

Route::controller(MapelController::class)->group(function(){
    Route::get('/mapel', 'index')->middleware('auth')->name('mapel');
    Route::post('/mapel', 'store')->name('mapel.store')->middleware('auth');
    Route::get('/mapel/table', 'table')->middleware('auth')->name('mapel.table');
    Route::get('/mapel/{any}/search', 'search')->middleware('auth')->name('mapel.search');
    Route::post('/mapel/destroy', 'destroy')->middleware('auth')->name('mapel.destroy');
    Route::post('/mapel/update', 'update')->middleware('auth')->name('mapel.update');
    Route::get('/mapel/{id}/edit', 'edit')->middleware('auth')->name('mapel.edit');
});

Route::controller(AbsenController::class)->group(function(){
    Route::get('/absen', 'index')->middleware('auth')->name('absen');
    Route::get('/absensi', 'edit')->middleware('auth')->name('absensi');
    Route::get('/absen/form', 'form')->middleware('auth')->name('absen.form');
    Route::get('/absen/{key}/form', 'formSearch')->middleware('auth')->name('absen.formSearch');
    Route::get('/absen/submit', 'submit')->middleware('auth')->name('absen.submit');
    Route::post('/absen', 'store')->middleware('auth')->name('absen.store');
    Route::post('/absen/update', 'update')->middleware('auth')->name('absen.update');
    Route::get('/absen/{id}/show', 'show')->middleware('auth')->name('absen.show');
    Route::get('/absen/report', 'report')->middleware('auth')->name('absen.report');
    Route::get('/absen/show', 'tabel_report')->middleware('auth')->name('absen.table_report');

    /**Ajax URL */
    Route::get('/absen/{kelas}/{mapel}/{tanggal}/{campus}/show', 'tableAbsen')->middleware('auth')->name('absen.tableAbsen');
    Route::get('/absen/{kelas}/{tanggal}/{campus}/show', 'listAbsen')->middleware('auth')->name('absen.listAbsen');

    Route::get('/absen/testing/json', 'testing')->middleware('auth')->name('absen.testing');

    /**Absen Guru&Staff */
    Route::get('/absen/guru/report', 'absenGuru')->middleware('auth')->name('absen.absenGuru');
    Route::get('/absen/guru/today', 'absenGuruToday')->middleware('auth')->name('absen.absenGuruToday');
    
});

Route::controller(ScoreController::class)->group(function(){
    Route::get('/nilai', 'index')->middleware('auth')->name('nilai');
    Route::post('/nilai', 'store')->middleware('auth')->name('nilai.store');
    Route::get('/nilai/report', 'report')->middleware('auth')->name('nilai.report');

    /**Ajax URL */
    Route::get('/nilai/{kelas}/{mapel}', 'form')->middleware('auth')->name('nilai.form');
    Route::get('/nilai/{kelas}/{mapel}/cekBtnSubmit', 'cekBtnSubmit')->middleware('auth')->name('nilai.cekBtnSubmit');
    Route::post('/nilai/tagFinal', 'tagFinal')->middleware('auth')->name('nilai.tagFinal');
    Route::get('/nilai/{kelas}/{mapel}/ajax', 'nilaiAjax')->middleware('auth')->name('nilai.nilaiAjax');
    Route::post('/nilai/update', 'updateNilai')->middleware('auth')->name('nilai.updateNilai');
    Route::post('/nilai/unlock', 'unlockNilai')->middleware('auth')->name('nilai.unlockNilai');
    Route::get('/report_nilai/{ta}/{semester}/{mapel}/{kelas}', 'report_nilai')->middleware('auth')->name('nilai.report_nilai');
    Route::get('/nilai_nilai_siswa/{ta}/{semester}/{kelas}/{siswa}', 'report_nilai_siswa')->middleware('auth')->name('nilai.report_nilai_siswa');
    Route::get('/nilai/{ta}/{semester}/json', 'ta_semester_json')->middleware('auth')->name('nilai.ta_semester_json');
    Route::get('/nilai/{ta}/{semester}/{kelas}/json', 'ta_semester_kelas_json')->middleware('auth')->name('nilai.ta_semester_kelas_json');
    Route::get('/nilai/{ta}/{semester}/{kelas}/{siswa}', 'report_per_siswa')->middleware('auth')->name('nilai.report_per_siswa');

    /**Kalender Pendidikan */
    Route::get('/nilai/kaldik', 'kaldik')->middleware('auth')->name('nilai.kaldik');
    Route::post('/nilai/kaldik/bulan/add', 'addKaldikBulan')->middleware('auth')->name('nilai.addKaldikBulan');
    Route::get('/nilai/kaldik/table/{campus}/{ta}/kaldikTable', 'kaldikTable')->middleware('auth')->name('nilai.kaldikTable');
    Route::post('/nilai/kaldik/unlock', 'kaldikUnlock')->middleware('auth')->name('nilai.kaldikUnlock');
    Route::post('/nilai/kaldik/lock', 'kaldikLock')->middleware('auth')->name('nilai.kaldikLock');
    Route::post('/nilai/kaldik/update-tanggal', 'kaldikUpdateTanggal')->middleware('auth')->name('nilai.kaldikUpdateTanggal');
    Route::post('/nilai/kaldik/addKeterangan', 'addKeterangan')->middleware('auth')->name('nilai.addKeterangan');
    Route::get('/kaldik/loadKeterangan', 'loadKeterangan')->middleware('auth')->name('nilai.loadKeterangan');
    Route::post('/kaldik/addKeterangan/hari', 'addKeteranganHari')->middleware('auth')->name('nilai.addKeteranganHari');
    Route::post('/kaldik/delete/keterangan', 'deleteKeterangan')->middleware('auth')->name('nilai.deleteKeterangan');
    Route::post('/kaldik/delete/bulan', 'deleteBulan')->middleware('auth')->name('nilai.deleteBulan');
    Route::post('/kaldik/update/keterangan', 'updateKeterangan')->middleware('auth')->name('nilai.updateKeterangan');

    /**Kaldik TK */
    Route::post('/kaldik/tk/upload', 'uploadKaldikTK')->middleware('auth')->name('nilai.uploadKaldikTK');
    Route::post('/kaldik/tk/delete', 'deleteKaldikTK')->middleware('auth')->name('nilai.deleteKaldikTK');
    Route::get('/kaldik/tk/{campus}/{ta}/loadFile', 'loadFileKaldikTK')->middleware('auth')->name('nilai.loadFileKaldikTK');
    /**json url */
    Route::get('/kaldik/loadKeteranganModal/json', 'loadKeteranganModal')->middleware('auth')->name('nilai.loadKeteranganModal');
    Route::get('/kaldik/he-semester/{campus}/{semester}/json', 'heSemester')->middleware('auth')->name('nilai.heSemester');

    /**Perangkat Pembelajaran */
    Route::get('/nilai/perangkat-pembelajaran', 'perangkatPembelajaran')->middleware('auth')->name('pp.perangkatPembelajaran');
    //ajax url
    Route::get('/pb/{campus}/{ta}/silabus', 'pbSilabus')->middleware('auth')->name('pp.pbSilabus');
    Route::get('/pb/{campus}/{ta}/prota', 'pbProta')->middleware('auth')->name('pp.pbProta');
    Route::get('/pb/{campus}/{ta}/prosem', 'pbProsem')->middleware('auth')->name('pp.pbProsem');
    Route::post('/pb/upload', 'pbUpload')->middleware('auth')->name('pp.pbUpload');
    Route::post('/pb/delete', 'pbDelete')->middleware('auth')->name('pp.pbDelete');

    Route::get('/testing/{campus}/{semester}/json', 'testingJson')->middleware('auth')->name('testingJson');
    
});

Route::controller(KeuanganController::class)->group(function(){
    Route::get('/keuangan', 'index')->middleware('auth')->name('keuangan');
    Route::get('/finance/transaction', 'create')->middleware('auth')->name('keuangan.transaksi');
    Route::post('/finance/transaction', 'store')->middleware('auth')->name('keuangan.store');
    Route::get('/finance/confirm', 'confirm')->middleware('auth')->name('finance.confirm');
    Route::get('/finance/{id}/verify', 'verify')->middleware('auth')->name('finance.verify');
    Route::get('/finance/{id}/invoice', 'invoice')->middleware('auth')->name('finance.invoice');
    Route::post('/finance/verify/confirm', 'confirm_verify')->middleware('auth')->name('finance.confirm_verify');
    Route::get('/finance/transaction/table', 'table_transaksi')->middleware('auth')->name('keuangan.table_transaksi');
    Route::get('/finance/transaction/tipe', 'tipe_transaksi')->middleware('auth')->name('keuangan.tipe_transaksi');
    Route::get('/finance/transaction/tipe/form', 'form_tipe')->middleware('auth')->name('keuangan.form_tipe');
    Route::post('/finance/transaction/tipe', 'tipe_transaksi_add')->middleware('auth')->name('keuangan.tipe_transaksi_add');
    Route::post('/finance/transaction/tipe/delete', 'tipe_transaksi_delete')->middleware('auth')->name('keuangan.tipe_transaksi_delete');

    /**Mutasi */
    Route::get('/finance/mutasi/', 'mutasi')->middleware('auth')->name('finance.mutasi');
    Route::get('/finance/mutasi/filter', 'mutasi_filter')->middleware('auth')->name('finance.mutasi_filter');

    /**Ajax */
    Route::get('/finance/{id}/tipe_json', 'typeJson')->middleware('auth')->name('finance.typeJson');
});

Route::controller(OrangtuaController::class)->group(function(){
    Route::get('/user/statistik', 'index')->middleware('auth')->name('siswa.ortu');
    Route::get('/user/e-raport', 'eraport')->middleware('auth')->name('siswa.eraport');
    Route::get('/user/invoice', 'invoice')->middleware('auth')->name('siswa.invoice');
    Route::get('/user/{id}/tahfidz', 'tahfidz')->middleware('auth')->name('siswa.tahfidz');
    Route::get('/user/invoice/{id}/show', 'showInvoice')->middleware('auth')->name('siswa.showInvoice');
    Route::get('/user/invoice/{id}/evidence', 'showEviden')->middleware('auth')->name('siswa.showEviden');
    Route::post('/user/invoice/checkout', 'checkout')->middleware('auth')->name('ortu.checkout');
    Route::get('/user/history-pembayaran', 'invoiceHistory')->middleware('auth')->name('ortu.invoiceHistory');
});

Route::controller(CampusController::class)->group(function(){
    Route::get('/campus', 'index')->middleware('auth')->name('campus');
    Route::post('/campus', 'store')->middleware('auth')->name('campus.store');
    Route::get('/campus/{id}/edit', 'edit')->middleware('auth')->name('campus.edit');
    Route::get('/campus/{id}/search', 'search')->middleware('auth')->name('campus.search');
    Route::post('/campus/{id}/update', 'update')->middleware('auth')->name('campus.update');
    Route::get('/campus/table', 'table')->middleware('auth')->name('campus.table');
});


//others controller
Route::controller(AccessController::class)->group(function(){
    Route::get('/acc_siswa/{id}/show', 'showSiswa')->middleware('auth')->name('acc_siswa.show');

    /**Notifikasi */
    Route::get('/finance/notif/json', 'finNotifJson')->middleware('auth')->name('finance.finNotifJson');
    Route::get('/ppdb/notif/json', 'ppdbNotifJson')->middleware('auth')->name('ppsb.ppdbNotifJson');
});


Route::controller(PDFController::class)->group(function(){
    Route::get('/absen/pdf', 'pdfAbsen')->middleware('auth')->name('absen.pdf');
    Route::get('/siswa/pdf', 'pdfSiswa')->middleware('auth')->name('siswa.pdf');
    Route::get('/ppdb/pdf', 'pdf_PPDB')->middleware('auth')->name('ppdb.pdf');
    Route::get('/ppdb/generate_image', 'generate_image')->middleware('auth')->name('ppdb.generate_image');
    Route::get('/nilai_per_kelas/{ta}/{semester}/{mapel}/{kelas}', 'report_nilai_kelas')->middleware('auth')->name('nilai.report_nilai_pdf');
    Route::get('/nilai/{ta}/{semester}/{kelas}/{siswa}/pdf', 'report_per_siswa')->middleware('auth')->name('nilai.report_per_siswa_pdf');
});

Route::controller(ExcelController::class)->group(function(){
    Route::get('/siswa/excel', 'exportSiswa')->middleware('auth')->name('siswa.exel');
    Route::get('/absen/excel/{kelas}/{mapel}/{tanggal}', 'exportAbsen')->middleware('auth')->name('absen.excel');
    Route::get('/teacher/excel', 'exportGuru')->middleware('auth')->name('guru.export');
    Route::get('/teacher/excel/import', 'importGuru')->middleware('auth')->name('guru.importGuru');
    Route::post('/teacher/excel/import', 'importGuruProses')->middleware('auth')->name('guru.importGuruProses');
    Route::get('/absen/guru/{mulai}/{sampai}/excel', 'absenGuru')->middleware('auth')->name('excel.absenGuru');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/ppdb/new', 'ppdb_new')->middleware('auth')->name('admin.ppdb_new');
    Route::post('/admin/ppdb/approval', 'ppdb_approval')->middleware('auth')->name('admin.ppdb_approval');
    Route::get('/admin/ppdb', 'ppdb')->middleware('auth')->name('admin.ppdb');
    Route::get('/admin/{id}/ppdb_review', 'ppdb_verification')->middleware('auth')->name('admin.ppdb_verification');
    Route::get('/admin/ppdb/rejected', 'ppdb_reject')->middleware('auth')->name('admin.ppdb_reject');
    Route::get('/admin/info/formulir', 'admin_informasi')->middleware('auth')->name('admin.informasi');
    Route::post('/admin/info/formulir', 'admin_informasi_update')->middleware('auth')->name('admin.informasi_update');
    Route::get('/admin/ppdb/master', 'master')->middleware('auth')->name('ppdb.master');
    Route::post('/admin/ppdb/master', 'master_ppdb_update')->middleware('auth')->name('ppdb.master_ppdb_update');
    Route::get('/tahun_akademik', 'tahun_akademik')->middleware('auth')->name('tahun_akademik');
    Route::post('/tahun_akademik', 'tahun_akademik_store')->middleware('auth')->name('tahun_akademik_store');
    Route::post('/tahun_akademik/update', 'tahun_akademik_update')->middleware('auth')->name('tahun_akademik_update');
    Route::post('/tahun_akademik/setActive', 'tahun_akademik_setActive')->middleware('auth')->name('tahun_akademik_setActive');
    Route::post('/tahun_akademik/delete/semester', 'deleteSemester')->middleware('auth')->name('deleteSemester');
    Route::get('/tahun_akademik/table', 'tahun_akademik_table')->middleware('auth')->name('tahun_akademik_table');
});

Route::controller(AddressController::class)->group(function(){
    Route::get('/address/provinces', 'getProvinces')->middleware('auth')->name('addres.getProvinces');
    Route::get('/address/{id}/province', 'getProvince')->middleware('auth')->name('addres.getProvince');

    Route::get('/address/{id}/regencies', 'getRegencies')->middleware('auth')->name('addres.getRegencies');
    Route::get('/address/{id}/regency', 'getRegency')->middleware('auth')->name('addres.getRegency');

    Route::get('/address/{id}/districts', 'getDistricts')->middleware('auth')->name('addres.getDistricts');
    Route::get('/address/{id}/district', 'getDistrict')->middleware('auth')->name('addres.getDistrict');

    Route::get('/address/{id}/villages', 'getVillages')->middleware('auth')->name('addres.getVillages');
    Route::get('/address/{id}/village', 'getVillage')->middleware('auth')->name('addres.getVillage');
});

Route::controller(TkController::class)->group(function(){
    Route::get('/tk/daily/report', 'dailyReport')->middleware('auth')->name('tk.dailyReport');
    Route::get('/tk/rppm-diniyah', 'rppmDiniyah')->middleware('auth')->name('tk.rppmDiniyah');
    Route::get('/tk/rppm-diniyah/{id}/print', 'rppmDiniyahPrint')->middleware('auth')->name('tk.rppmDiniyahPrint');

    Route::get('/tk/raport-semester', 'raportSemester')->middleware('auth')->name('tk.raportSemester');
    Route::get('/tk/raport-semester/{narasi}/print', 'raportSemesterPrint')->middleware('auth')->name('tk.raportSemesterPrint');
    Route::get('/tk/raport-semester/{narasi}/print-hafalan', 'raportSemesterPrintHafalan')->middleware('auth')->name('tk.raportSemesterPrintHafalan');

    Route::get('/tk/raport-mid-semester', 'raportMid')->middleware('auth')->name('tk.raportMid');
    Route::get('/tk/raport-mid-semester/penilaian', 'raportMidPenilaian')->middleware('auth')->name('tk.raportMidPenilaian');
    Route::get('/tk/raport-mid-semester/form', 'raportMidForm')->middleware('auth')->name('tk.raportMidForm');
    Route::get('/tk/raport-mid-semester/{id}/print', 'raportMidPrint')->middleware('auth')->name('tk.raportMidPrint');

    /**Ajax */
    Route::get('/tk/ajax/tableDailyReport', 'tableDailyReport')->middleware('auth')->name('tk.tableDailyReport');
    Route::post('/tk/dr/addKeterangan', 'drAddKeterangan')->middleware('auth')->name('tk.drAddKeterangan');
    Route::post('/tk/dr/upload', 'drUploadFoto')->middleware('auth')->name('tk.drUploadFoto');
    Route::post('/tk/dr/subtema', 'drSubTema')->middleware('auth')->name('tk.drSubTema');
    Route::post('/tk/dr/addSubTema', 'addSubTema')->middleware('auth')->name('tk.addSubTema');
    Route::post('/tk/dr/delete', 'deleteTema')->middleware('auth')->name('tk.deleteTema');
    Route::post('/tk/dr/deleteSub', 'deleteSub')->middleware('auth')->name('tk.deleteSub');

    /**json */
    Route::get('/tk/dr/loadData/json', 'loadDataJson')->middleware('auth')->name('tk.loadDataJson');
});

Route::controller(RaportSdController::class)->group(function(){
    Route::get('/raport/km/kompetensi-dasar', 'kd')->middleware('auth', 'allguru')->name('raportSd.kompetensiDasar');
    Route::get('/raport/sd/penilaian', 'penilaian')->middleware('auth', 'sdguru')->name('raportSd.penilaian');
    Route::get('/raport/sd', 'raport')->middleware('auth', 'sdadmin')->name('raportSd.raport');
    Route::get('/raport/sd/{public_token}/cetak', 'raportCetak')->middleware('auth', 'sdadmin')->name('raportSd.raport-cetak');
});

Route::controller(RaportController::class)->group(function(){
    Route::get('/raport/km/penilaian', 'penilaian')->middleware('auth', 'allguru')->name('raportKm.penilaian');
    Route::get('/raport/kurikulum-merdeka', 'index')->middleware('auth', 'smpsmkadmin')->name('raportKm.index');
    Route::get('/raport/kurikulum-merdeka/{id}/print', 'printRaport')->middleware('auth', 'smpsmkadmin')->name('raportKm.printRaport');
});

Route::controller(PaymentControlller::class)->group(function () {
    Route::get('/finance/user-payment', 'index')->middleware('auth', 'sditfinance')->name('finance.userPayment');
    Route::get('/finance/api-setting', 'apiSetting')->middleware('auth', 'finance')->name('finance.apiSetting');
    Route::get('/finance/potongan-tagihan', 'potonganTagihan')->middleware('auth', 'finance')->name('finance.potonganTagihan');
    Route::get('/finance/payment-master', 'paymentMaster')->middleware('auth', 'finance')->name('finance.paymentMaster');
    Route::get('/finance/payment-unpaid', 'paymentUnpaid')->middleware('auth', 'finance')->name('finance.paymentUnpaid');
    Route::get('/finance/payment-history', 'paymentHistory')->middleware('auth', 'finance')->name('finance.paymentHistory');
    Route::get('/finance/send-notifikasi-wa', 'sendNotifikasiWA')->middleware('auth')->name('finance.sendNotifikasiWA');
});
