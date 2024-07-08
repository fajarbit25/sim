<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Level;
use App\Models\Semester;
use App\Models\Campu;
use App\Models\Jenjang;
use App\Models\Alamat;
use App\Models\BiodataTeacher;
use App\Models\Formulirinformation;
use App\Models\KepegawaianTeacher;
use App\Models\KompetensiKhususTeacher;
use App\Models\Mutation;
use App\Models\PenugasanTeacher;
use App\Models\Ppdbmaster;
use App\Models\RaportMidTKMaster;
use App\Models\RaportTKMaster;
use App\Models\RppmdiniyahMaster;
use App\Models\RppmdiniyahMateri;
use App\Models\SchoolTeacher;
use App\Models\TagAbsen;
use App\Models\TagKaldik;
use App\Models\Teacher;
use App\Models\Tipetransaction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**Superuser */
        User::create([
            'first_name'        => 'Superadmin',
            'email'             => 'sa@iqis.sch.id',
            'level'             => 0,
            'status'            => 2,
            'phone'             => '0895330078690',
            'telephone'         => NULL,
            'photo'             => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'         => 1,
            'email_verified_at' => '2023-09-02',
            'password'          => Hash::make('admin'),
            'kelas'             => 0,
        ]);

        Teacher::create([
            'user_id'       => 1,
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => NULL,
            'tanggal_lahir' => NULL,
            'ibu_kandung'   => NULL,
            'nik'           => '0000000000000000'
        ]);

        BiodataTeacher::create(['user_id'=> 1,]);
        Alamat::create(['user_id'   => 1,]);
        SchoolTeacher::create(['user_id'   => 1,]);
        KepegawaianTeacher::create(['user_id'   => 1,]);
        KompetensiKhususTeacher::create(['user_id' => 1]);
        PenugasanTeacher::create(['user_id' => 1]);

        /**Admin TK */
        User::create([
            'first_name'        => 'Admin TKIT',
            'email'             => 'admins-tk@iqis.sch.id',
            'level'             => 1,
            'status'            => 2,
            'phone'             => '081000000001',
            'telephone'         => NULL,
            'photo'             => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'         => 2,
            'email_verified_at' => '2023-09-02',
            'password'          => Hash::make('iqis@2024'),
            'kelas'             => 0,
        ]);

        Teacher::create([
            'user_id'       => 2,
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir'  => NULL,
            'tanggal_lahir' => NULL,
            'ibu_kandung'   => 'nama-ibu',
            'nik'           => '0000000000000001'
        ]);

        BiodataTeacher::create(['user_id'=> 2,]);
        Alamat::create(['user_id'   => 2,]);
        SchoolTeacher::create(['user_id'   => 2,]);
        KepegawaianTeacher::create(['user_id'   => 2,]);
        KompetensiKhususTeacher::create(['user_id' => 2,]);
        PenugasanTeacher::create(['user_id' => 2,]);

        /**Admin TK */
        User::create([
            'first_name'        => 'Admin SDIT',
            'email'             => 'admins@iqis.sch.id',
            'level'             => 1,
            'status'            => 2,
            'phone'             => '081000000002',
            'telephone'         => NULL,
            'photo'             => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'         => 3,
            'email_verified_at' => '2023-09-02',
            'password'          => Hash::make('iqis@2024'),
            'kelas'             => 0,
        ]);

        Teacher::create([
            'user_id'       => 3,
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir'  => NULL,
            'tanggal_lahir' => NULL,
            'ibu_kandung'   => 'nama-ibu',
            'nik'           => '0000000000000002'
        ]);

        BiodataTeacher::create(['user_id'=> 3,]);
        Alamat::create(['user_id'   => 3,]);
        SchoolTeacher::create(['user_id'   => 3,]);
        KepegawaianTeacher::create(['user_id'   => 3,]);
        KompetensiKhususTeacher::create(['user_id' => 3,]);
        PenugasanTeacher::create(['user_id' => 3,]);


        /**Admin TK */
        User::create([
            'first_name'        => 'Admin SMPIT',
            'email'             => 'admins-smpit@iqis.sch.id',
            'level'             => 1,
            'status'            => 2,
            'phone'             => '081000000003',
            'telephone'         => NULL,
            'photo'             => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'         => 4,
            'email_verified_at' => '2023-09-02',
            'password'          => Hash::make('iqis@2024'),
            'kelas'             => 0,
        ]);

        Teacher::create([
            'user_id'       => 4,
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir'  => NULL,
            'tanggal_lahir' => NULL,
            'ibu_kandung'   => 'nama-ibu',
            'nik'           => '0000000000000003'
        ]);

        BiodataTeacher::create(['user_id'=> 4,]);
        Alamat::create(['user_id'   => 4,]);
        SchoolTeacher::create(['user_id'   => 4,]);
        KepegawaianTeacher::create(['user_id'   => 4,]);
        KompetensiKhususTeacher::create(['user_id' => 4,]);
        PenugasanTeacher::create(['user_id' => 4,]);

        /**Admin TK */
        User::create([
            'first_name'        => 'Admin SMKIT',
            'email'             => 'admins-smkit@iqis.sch.id',
            'level'             => 1,
            'status'            => 2,
            'phone'             => '081000000004',
            'telephone'         => NULL,
            'photo'             => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'         => 5,
            'email_verified_at' => '2023-09-02',
            'password'          => Hash::make('iqis@2024'),
            'kelas'             => 0,
        ]);

        Teacher::create([
            'user_id'       => 5,
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir'  => NULL,
            'tanggal_lahir' => NULL,
            'ibu_kandung'   => 'nama-ibu',
            'nik'           => '0000000000000004'
        ]);

        BiodataTeacher::create(['user_id'=> 5,]);
        Alamat::create(['user_id'   => 5,]);
        SchoolTeacher::create(['user_id'   => 5,]);
        KepegawaianTeacher::create(['user_id'   => 5,]);
        KompetensiKhususTeacher::create(['user_id' => 5,]);
        PenugasanTeacher::create(['user_id' => 5,]);

        Tipetransaction::create(['campus_id' => 1, 'tipe' => 'PPDB']);
        Tipetransaction::create(['campus_id' => 2, 'tipe' => 'PPDB']);
        Tipetransaction::create(['campus_id' => 3, 'tipe' => 'PPDB']);
        Tipetransaction::create(['campus_id' => 4, 'tipe' => 'PPDB']);
        Tipetransaction::create(['campus_id' => 5, 'tipe' => 'PPDB']);

        Mutation::create([
            'inv_id'    => 10001,
            'nominal'   => 0,
            'saldo_awal'=> 0,
            'saldo_akhir'=>0,
            'campus_id' => 5,
            'trx_by'    =>1,
        ]);
        Mutation::create([
            'inv_id'    => 10002,
            'nominal'   => 0,
            'saldo_awal'=> 0,
            'saldo_akhir'=>0,
            'campus_id' => 4,
            'trx_by'    =>1,
        ]);
        Mutation::create([
            'inv_id'    => 10002,
            'nominal'   => 0,
            'saldo_awal'=> 0,
            'saldo_akhir'=>0,
            'campus_id' => 3,
            'trx_by'    =>1,
        ]);
        Mutation::create([
            'inv_id'    => 10002,
            'nominal'   => 0,
            'saldo_awal'=> 0,
            'saldo_akhir'=>0,
            'campus_id' => 2,
            'trx_by'    =>1,
        ]);
        Mutation::create([
            'inv_id'    => 10002,
            'nominal'   => 0,
            'saldo_awal'=> 0,
            'saldo_akhir'=>0,
            'campus_id' => 1,
            'trx_by'    =>1,
        ]);
        
       
        

        Level::create([
            'kode_level'    => 'Admin',
            'nama_level'    => 'Administrator',
        ]);
        Level::create([
            'kode_level'    => 'Guru',
            'nama_level'    => 'Guru',
        ]);
        Level::create([
            'kode_level'    => 'Staf',
            'nama_level'    => 'Staff',
        ]);
        Level::create([
            'kode_level'    => 'User',
            'nama_level'    => 'Siswa/Orang Tua',
        ]);
        Level::create([
            'kode_level'    => 'Finance',
            'nama_level'    => 'Bendahara',
        ]);

        Semester::create([
            'semester_kode' => 1,
            'tahun_ajaran'  => '2022/2023',
            'is_active'     => 'false',
        ]);
        Semester::create([
            'semester_kode' => 2,
            'tahun_ajaran'  => '2023/2024',
            'is_active'     => 'true',
        ]);

        
        //campus
        Campu::create([
            'npsn'          => '10219612582',
            'status'        => NULL,
            'bentuk_pendidikan' => NULL,
            'kepemilikan'   => NULL,
            'sk_pendirian'  => NULL,
            'tanggal_sk'    => NULL,
            'sk_izin_operasi'   => NULL,
            'tanggal_sk_izin_operasi'   => NULL,
            'campus_name'   => 'Yayasan Ibnul Qayyim Makassar',
            'campus_initial'=> 'IQIS',
            'campus_tingkat'=> 0,
            'campus_contact'=> '08000000000',
            'email_campus'  => 'info@iqis.sch.id',
            'campus_kepsek' => 'Ketua Yayasan',
            'niy_kepsek'    => '000000 000000 1 0',
            'campus_alamat' => 'Kantor Yayasan Iqis Makassar',
            'yt'            => 'www.youtube.com',
            'fb'            => 'www.facebook.com',
            'ig'            => 'www.instagram.com',
            'tele'          => 't.me',  
        ]);

        Campu::create([
            'npsn'                      => '70003500',
            'status'                    => 'Swasta',
            'bentuk_pendidikan'         => 'TK',
            'kepemilikan'               => 'Yayasan',
            'sk_pendirian'              => '3',
            'tanggal_sk'                => '2019-01-31',
            'sk_izin_operasi'           => '503/048/PAUD-TK/DPM-PTSP/II/2021',
            'tanggal_sk_izin_operasi'   => '2021-02-10',
            'campus_name'               => 'TKIT Ibnul Qayyim Makassar',
            'campus_initial'            => 'TKIT IQIS',
            'campus_tingkat'            => 1,
            'campus_contact'            => '082193976158',
            'email_campus'              => 'tkit@iqis.sch.id',
            'campus_kepsek'             => 'Hikmahyanti, A.Md',
            'niy_kepsek'                => '000000 000000 1 0',
            'campus_alamat'             => 'Jl. Goa Ria Taman Bunga 2 No.17B, Sudiang Raya, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90552',
            'yt'                        => 'www.youtube.com',
            'fb'                        => 'www.facebook.com',
            'ig'                        => 'www.instagram.com',
            'tele'                      => 't.me',  
        ]);

        Campu::create([
            'npsn'                      => '69829167',
            'status'                    => 'Swasta',
            'bentuk_pendidikan'         => 'SD',
            'kepemilikan'               => 'Yayasan',
            'sk_pendirian'              => '03-',
            'tanggal_sk'                => '2014-01-22',
            'sk_izin_operasi'           => '503/0023/DIKDAS/DPM-PTSP/IX/2019',
            'tanggal_sk_izin_operasi'   => '2020-06-04',
            'campus_name'               => 'SDIT Ibnul Qayyim Makassar',
            'campus_initial'            => 'SDIT IQIS',
            'campus_tingkat'            => 2,
            'campus_contact'            => '081341311314',
            'email_campus'              => 'sdit@iqis.sch.id',
            'campus_kepsek'             => 'Nama Kepala Sekolah',
            'niy_kepsek'                => '000000 000000 1 0',
            'campus_alamat'             => 'Jl. Taman Bunga Sudiang Kel No.2, Laikang, Biringkanaya, Makassar City, South Sulawesi 90242',
            'yt'                        => 'www.youtube.com',
            'fb'                        => 'www.facebook.com',
            'ig'                        => 'www.instagram.com',
            'tele'                      => 't.me',  
        ]);

        Campu::create([
            'npsn'                      => '70003152',
            'status'                    => 'Swasta',
            'bentuk_pendidikan'         => 'SMP',
            'kepemilikan'               => 'Yayasan',
            'sk_pendirian'              => '3',
            'tanggal_sk'                => '2019-01-31',
            'sk_izin_operasi'           => '503/0020/DIKDAS/DPM-PTSP/IX/2019',
            'tanggal_sk_izin_operasi'   => '2020-06-04',
            'campus_name'               => 'SMPIT Ibnul Qayyim Makassar',
            'campus_initial'            => 'SMPIT IQIS',
            'campus_tingkat'            => 3,
            'campus_contact'            => '08114455432',
            'email_campus'              => 'smpit@iqis.sch.id',
            'campus_kepsek'             => 'Nama Kepala Sekolah',
            'niy_kepsek'                => '000000 000000 1 0',
            'campus_alamat'             => 'JL. Perintis Kemerdekaan KM. 15, Komp. Manggala Junction Blok B 11, Pai, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90243',
            'yt'                        => 'www.youtube.com',
            'fb'                        => 'www.facebook.com',
            'ig'                        => 'www.instagram.com',
            'tele'                      => 't.me',  
        ]);

        Campu::create([
            'npsn'                      => '70031494',
            'status'                    => 'Swasta',
            'bentuk_pendidikan'         => 'SMK',
            'kepemilikan'               => 'Yayasan',
            'sk_pendirian'              => '21/K.02/PTSP/2022',
            'tanggal_sk'                => '2022-06-20',
            'sk_izin_operasi'           => '21/K.02/PTSP/2022',
            'tanggal_sk_izin_operasi'   => '2022-06-20',
            'campus_name'               => 'SMKIT Ibnul Qayyim Makassar',
            'campus_initial'            => 'SMKIT IQIS',
            'campus_tingkat'            => 4,
            'campus_contact'            => '8114411432',
            'email_campus'              => 'smkit@iqis.sch.id',
            'campus_kepsek'             => 'Nama Kepala Sekolah',
            'niy_kepsek'                => '000000 000000 1 0',
            'campus_alamat'             => 'JL. Perintis Kemerdekaan KM. 15, Komp. Manggala Junction Blok B 11, Pai, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90243',
            'yt'                        => 'www.youtube.com',
            'fb'                        => 'www.facebook.com',
            'ig'                        => 'www.instagram.com',
            'tele'                      => 't.me',  
        ]);

        Jenjang::create(['jenjang_pendidikan'   => 'TK']);
        Jenjang::create(['jenjang_pendidikan'   => 'SD']);
        Jenjang::create(['jenjang_pendidikan'   => 'SMP']);
        Jenjang::create(['jenjang_pendidikan'   => 'SMA']);


        //Informasi PPDB
        Formulirinformation::create([
            'campus_id'     => 5,
            'pesan'         => 'Isi Pesan SMKIT',
        ]);
        Formulirinformation::create([
            'campus_id'     => 4,
            'pesan'         => 'Isi Pesan SMPIT',
        ]);
        Formulirinformation::create([
            'campus_id'     => 3,
            'pesan'         => 'Isi Pesan SDIT',
        ]);
        Formulirinformation::create([
            'campus_id'     => 2,
            'pesan'         => 'Isi Pesan TKIT',
        ]);



        

        Ppdbmaster::create([
            'tahun_id'          => '2023/2024',
            'tahun_penerimaan'  => '2024',
            'gelombang'         => 1,
            'status'            => 'Dibuka',
            'tanggal_mulai'     => '2024-01-01',
            'tanggal_selesai'   => '2024-05-30',
        ]);

        TagAbsen::create(['campus_id' => 0, 'tag_absen' => 1, 'user_id' => 0]);
        TagAbsen::create(['campus_id' => 1, 'tag_absen' => 1, 'user_id' => 0]);
        TagAbsen::create(['campus_id' => 2, 'tag_absen' => 1, 'user_id' => 0]);
        TagAbsen::create(['campus_id' => 3, 'tag_absen' => 1, 'user_id' => 0]);
        TagAbsen::create(['campus_id' => 4, 'tag_absen' => 1, 'user_id' => 0]);
        TagAbsen::create(['campus_id' => 5, 'tag_absen' => 1, 'user_id' => 0]);

        TagKaldik::create(['campus_id' => 0, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);
        TagKaldik::create(['campus_id' => 1, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);
        TagKaldik::create(['campus_id' => 2, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);
        TagKaldik::create(['campus_id' => 3, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);
        TagKaldik::create(['campus_id' => 4, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);
        TagKaldik::create(['campus_id' => 5, 'tag_name'=> 'Default', 'color' => 'rgb(255,255,255)']);

        TagKaldik::create(['campus_id' => 0, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);
        TagKaldik::create(['campus_id' => 1, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);
        TagKaldik::create(['campus_id' => 2, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);
        TagKaldik::create(['campus_id' => 3, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);
        TagKaldik::create(['campus_id' => 4, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);
        TagKaldik::create(['campus_id' => 5, 'tag_name'=> 'Haril Libur', 'color' => 'rgb(255,0,0)']);



        $dataMateri = [
            ['materi' => 'Pembukaan'],
            ['materi' => 'Tahfidz'],
            ['materi' => 'Aqidah'],
            ['materi' => 'Adab & Akhlak'],
            ['materi' => 'Hadits & Doa'],
            ['materi' => 'Bahasa Inggris'],
            ['materi' => 'Bahasa Arab'],
            ['materi' => 'Sirah'],
            ['materi' => 'Fiqih & ibadah'],
            ['materi' => 'Sains'],
        ];

        foreach ($dataMateri as $itemMateri) {
            RppmdiniyahMateri::create([
                'materi' => $itemMateri['materi'],
            ]);
        }

        $dataMaster = [
            ["Pembukaan", "Berbaris"],
            ["Pembukaan", "Dzikir pagi dan doa sebelum belajar"],
            ["Tahfidz", "Al Fatihah / الفاتحة"],
            ["Tahfidz", "An Naas/ الناس"],
            ["Tahfidz", "Al Falaq/ الفلق"],
            ["Tahfidz", "Al Ikhlash/ الإخلاص"],
            ["Tahfidz", "Al Lahab/ اللهب"],
            ["Tahfidz", "An Nashr/ النصر"],
            ["Tahfidz", "Al-Kaafiruun/ الكافرون"],
            ["Tahfidz", "Al Kautsar/ الكوثر"],
            ["Tahfidz", "Al Maa’uun/ الماعون"],
            ["Tahfidz", "Quraisy/ قريش"],
            ["Tahfidz", "Al Fiil/ الفيل"],
            ["Tahfidz", "Al Humazah/ الهمزة"],
            ["Tahfidz", "Al ‘Ashr/العصر"],
            ["Tahfidz", "At Takaatsur/التكاثر"],
            ["Tahfidz", "Al Qaari’ah/ القارعة"],
            ["Tahfidz", "Al ‘Aadiyaat/ العاديات"],
            ["Tahfidz", "Az Zalzalah/ الزلزلة"],
            ["Tahfidz", "Al Bayyinah/ البينة"],
            ["Tahfidz", "Al Qadr/ القدر"],
            ["Tahfidz", "Al ‘Alaq/ العلق"],
            ["Tahfidz", "At Tiin/ التين"],
            ["Tahfidz", "Al-Insyirah/ الانشراح"],
            ["Tahfidz", "Adh Dhuha/ الضحى"],
            ["Tahfidz", "Al Lail/ الليل"],
            ["Tahfidz", "Asy Syams/ الشمس"],
            ["Tahfidz", "Al Balad/ البلد"],
            ["Tahfidz", "Al Fajr/الفجر"],
            ["Tahfidz", "Al Ghaasyiyah/ الغاشية"],
            ["Tahfidz", "Al A’laa/ الأعلى"],
            ["Tahfidz", "Ath Thaariq/ الطارق"],
            ["Tahfidz", "Al Buruj/ البروج"],
            ["Tahfidz", "Al Insyiqaq/ الإنشقاق"],
            ["Tahfidz", "Al Muthaffifin/ المطففين"],
            ["Tahfidz", "Al Infithar/ الإنفطار"],
            ["Tahfidz", "At Takwir/ التكوير"],
            ["Tahfidz", "‘Abasa/ عبس"],
            ["Tahfidz", "An Naazi’aat/ النازِعات"],
            ["Tahfidz", "An Naba’/ النبإ"],
            ["Aqidah", "Mengapa kita wajib belajar tauhid?"],
            ["Aqidah", "Apa itu tauhid?"],
            ["Aqidah", "Dari mana kita mengambil aqidah kita?"],
            ["Aqidah", "Siapa yang menciptakan alam semesta?"],
            ["Aqidah", "Siapa Rabb mu?"],
            ["Aqidah", "Di mana Allah?"],
            ["Aqidah", "Apa dalil Allah di atas Arsy?"],
            ["Aqidah", "Apa makna istawa?"],
            ["Aqidah", "Apa agama mu?"],
            ["Aqidah", "Siapa nabi mu?"],
            ["Aqidah", "Apa kitab suci mu?"],
            ["Aqidah", "Apa makna liy’abuduna?"],
            ["Aqidah", "Apa makna Laa ilaaha illallaah?"],
            ["Aqidah", "Ibadah yang terbesar"],
            ["Aqidah", "Maksiat yang terbesar"],
            ["Aqidah", "Apa itu syirik?"],
            ["Aqidah", "Ada berapa macam Tauhid? Sebutkan!"],
            ["Aqidah", "Apa makna tauhid rububiyah?"],
            ["Aqidah", "Contoh tauhid Rububiyah"],
            ["Aqidah", "Makna tauhid uluhiyyah"],
            ["Aqidah", "Contoh tauhid uluhiyyah"],
            ["Aqidah", "Apakah Allah memiliki nama dan sifat?"],
            ["Aqidah", "Dari mana kita menambil nama-nama dan sifat Allah?"],
            ["Aqidah", "Apakah Sifat Allah sama dengan sifat manusia?"],
            ["Aqidah", "Apa dalilnya?"],
            ["Aqidah", "Al-Qur’an perkataan siapa?"],
            ["Aqidah", "Rukun Islam"],
            ["Aqidah", "Nama-nama Allah dan artinya"],
            ["Aqidah", "6 Rukun Iman"],
            ["Aqidah", "Beriman kepada Allah"],
            ["Aqidah", "Beriman kepada malaikat Allah"],
            ["Aqidah", "Beriman kepada kitab-kitab Allah"],
            ["Aqidah", "Beriman kepada Rasul-Rasul Allah"],
            ["Aqidah", "Beriman kepada hari akhir"],
            ["Aqidah", "Beriman kepada takdir baik dan buruk"],
            ["Aqidah", "Rukun islam ada 5"],
            ["Aqidah", "Hadist rukun islam (hadist jibril)"],
            ["Aqidah", "1 kalimat syahadat dan artinya"],
            ["Aqidah", "Rukun laailahailaullah"],
            ["Aqidah", "Makna muhammadarasululllah"],
            ["Aqidah", "Menegakkan shalat"],
            ["Aqidah", "Yang harus diperhatikan dalam shalat"],
            ["Aqidah", "Tingfkatan 2 iman"],
            ["Aqidah", "Rukun iman"],
            ["Aqidah", "Dalil dari Al-Qur’an (Al-Baqarah:177)"],
            ["Aqidah", "Dalil tentang takdir dari Al-Qur’an (Al-Qamar: 49)"],
            ["Aqidah", "Tingkatam 3 Ihsan (rukyunnya ada 1)"],
            ["Aqidah", "Kalimat Thayyibah - masyAllah"],
            ["Aqidah", "Kalimat Thayyibah - SubahanAllah"],
            ["Aqidah", "Kalimat Thayyibah - Alhamdulillah"],
            ["Aqidah", "Kalimat Thayyibah - Allahuakbar"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap diri sendiri"],
            ["Adab & Akhlak", "Adab tidur"],
            ["Adab & Akhlak", "Adab bangun tidur"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap orangtua"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap guru"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap teman"],
            ["Adab & Akhlak", "Adab makan dan minum"],
            ["Adab & Akhlak", "Adab di kamar mandi"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap hewan"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap tanaman"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap saudara"],
            ["Adab & Akhlak", "Adab berpakaian"],
            ["Adab & Akhlak", "Adab masuk rumah"],
            ["Adab & Akhlak", "Adab keluar rumah"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap Allah"],
            ["Adab & Akhlak", "Adab dan akhlaq bersama Al-Qur’am"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap Rasulullah"],
            ["Adab & Akhlak", "Adab mau tidur (ayat kursi)"],
            ["Adab & Akhlak", "Adab bangun tidur (dzikirnya)"],
            ["Adab & Akhlak", "Adab bersin dan menguap"],
            ["Adab & Akhlak", "Adab berbicara"],
            ["Adab & Akhlak", "Adab memberi salam"],
            ["Adab & Akhlak", "Adab meminta izin"],
            ["Adab & Akhlak", "Adab bertamu"],
            ["Adab & Akhlak", "Adab menerima tamu"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap kedua orang tua"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap guru"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap teman"],
            ["Adab & Akhlak", "Adab dan akhalq terhadap tetangga"],
            ["Adab & Akhlak", "Adab dan akhlaq terhadap keluarga"],
            ["Adab & Akhlak", "Adab ketika di masjid"],
            ["Adab & Akhlak", "Adab menjenguk orang sakit"],
            ["Adab & Akhlak", "Adab terhadap binatang"],
            ["Adab & Akhlak", "Adab terhadap tanaman"],
            ["Hadits & Doa", "Hadits niat"],
            ["Hadits & Doa", "Hadits taqwa"],
            ["Hadits & Doa", "Hadits rukun islam"],
            ["Hadits & Doa", "Hadits urgensi shadat"],
            ["Hadits & Doa", "Hadits berkata baik atau diam"],
            ["Hadits & Doa", "Doa sebelum tidur"],
            ["Hadits & Doa", "Doa bangun tidur"],
            ["Hadits & Doa", "Doa untuk kedua orang tua"],
            ["Hadits & Doa", "Doa menambah ilmu"],
            ["Hadits & Doa", "Doa masuk dan keluar kamar mandi"],
            ["Hadits & Doa", "Doa sebelum makan"],
            ["Hadits & Doa", "Doa apabila lupa membaca doa sebelum makan"],
            ["Hadits & Doa", "Doa sesudah makan"],
            ["Hadits & Doa", "Doa memakai baju"],
            ["Hadits & Doa", "Doa memakai baju baruu"],
            ["Hadits & Doa", "Doa masuk rumah"],
            ["Hadits & Doa", "Doa keluar rumah"],
            ["Hadits & Doa", "Hadits larangan marah"],
            ["Hadits & Doa", "Hadits akhlaq mulia"],
            ["Hadits & Doa", "Hadits mempelajari Al-Qur’an"],
            ["Hadits & Doa", "Hadits Jagalah Allah"],
            ["Hadits & Doa", "Hadits meminta kepada Allah"],
            ["Hadits & Doa", "Doa ketika bersin"],
            ["Hadits & Doa", "Dzikir sebelum tidur (ayat kursi)"],
            ["Hadits & Doa", "Dzikir bangun tidur"],
            ["Hadits & Doa", "Doa bagi orang yang berbuat baik kepada kita"],
            ["Hadits & Doa", "Doa ketika turun hujan"],
            ["Hadits & Doa", "Doa ketika berhenti hujan"],
            ["Hadits & Doa", "Dzikir mendengar halilintar"],
            ["Hadits & Doa", "Doa naik kendaraan"],
            ["Hadits & Doa", "Hadits rukun iman"],
            ["Hadits & Doa", "Hadits hamba yang dicintai Allah"],
            ["Hadits & Doa", "Hadits orang yang dikehendaki kebaikan untuk Allah"],
            ["Hadits & Doa", "Hadits larangan membahayakan orang lain"],
            ["Hadits & Doa", "Hadits mencintai saudara"],
            ["Hadits & Doa", "Doa sebelum dan setelah wudhu"],
            ["Hadits & Doa", "Doa masuk masjid"],
            ["Hadits & Doa", "Doa ketika mendengar adzan"],
            ["Hadits & Doa", "Doa keberkahan bagi orang lain"],
            ["Hadits & Doa", "Hadits golongan yang menang"],
            ["Hadits & Doa", "Hadits amalan utama"],
            ["Hadits & Doa", "Hadits meninggalkan yang tidak bermanfaat"],
            ["Hadits & Doa", "Hadits Allah Mahabaik"],
            ["Hadits & Doa", "Hadits Malu"],
            ["Hadits & Doa", "Doa memohon kebaikan dunia akhirat"],
            ["Hadits & Doa", "Doa mohon diperbaiki urusan dunia dan akhirat"],
            ["Fiqih & Ibadah", "Pengertian wudhu dan air yang digunakan untuk berwudhu"],
            ["Fiqih & Ibadah", "Tata cara wudhu"],
            ["Fiqih & Ibadah", "Pembatal-pembatal wudhu"],
            ["Fiqih & Ibadah", "Perkara-perkara yang diwajibkan untuk berwudhu"],
            ["Fiqih & Ibadah", "Perkara-perkara yang disunahkan untuk berwudhu"],
            ["Fiqih & Ibadah", "Tayamum"],
            ["Fiqih & Ibadah", "Kapan diperbolehkan"],
            ["Fiqih & Ibadah", "Tata cara"],
            ["Fiqih & Ibadah", "Shalat wajib dan waktunya"],
            ["Fiqih & Ibadah", "Syarat-syarat sah shalat"],
            ["Fiqih & Ibadah", "Rukun-rukun shalat"],
            ["Fiqih & Ibadah", "Gerakan shalat"],
            ["Fiqih & Ibadah", "Hal-hal yang membatalkan shalat"],
            ["Fiqih & Ibadah", "Beberapa shalat sunnah"],
            ["Fiqih & Ibadah", "Menghadap kiblat, berdiri dan niat"],
            ["Fiqih & Ibadah", "Takbiratul ihram dan doa iftitah"],
            ["Fiqih & Ibadah", "Membaca ta’awudz, Al-fatihah dan surat-surat pendek"],
            ["Fiqih & Ibadah", "Bacaan ruku’"],
            ["Fiqih & Ibadah", "Bacaan i’tidal"],
            ["Fiqih & Ibadah", "Bacaan sujud"],
            ["Fiqih & Ibadah", "Bacaan duduk diantara 2 sujud"],
            ["Fiqih & Ibadah", "Duduk istirahat"],
            ["Fiqih & Ibadah", "Bacaan tasyahud awal"],
            ["Fiqih & Ibadah", "Bacaan tasyahud akhir, shalawat"],
            ["Fiqih & Ibadah", "Doa mohon perlindungan dari 4 perkara"],
            ["Fiqih & Ibadah", "Macam-macam zakat"],
            ["Fiqih & Ibadah", "Golongan yang berhak menerima zakat"],
            ["Fiqih & Ibadah", "Puasa di bulan ramadhan"],
            ["Fiqih & Ibadah", "Haji dan umrah (tata cara dan doa-doanya)"],
            ["Bahasa Inggris", "DIISI SENDIRI"],
            ["Bahasa Arab", "DIISI SENDIRI"],
            ["Sirah", "Nabi Adam"],
            ["Sirah", "Nabi Idris"],
            ["Sirah", "Nabi Nuh"],
            ["Sirah", "Nabi Hud"],
            ["Sirah", "Nabi Shalih"],
            ["Sirah", "Nabi Ibrahim"],
            ["Sirah", "Nabi Luth"],
            ["Sirah", "Nabi Ismail"],
            ["Sirah", "Nabi Ishaq"],
            ["Sirah", "Nabi Ya’qub"],
            ["Sirah", "Nabi Yusuf"],
            ["Sirah", "Nabi Ayyub"],
            ["Sirah", "Nabi Yunus"],
            ["Sirah", "Nabi Sulaiman"],
            ["Sirah", "Nabi Musa"],
            ["Sirah", "Nabi Harun"],
            ["Sirah", "Nabi Isa"],
            ["Sirah", " Shallallahu 'Alaihi wa Sallam"],
            ["Sirah", "Abu Bakar As-Shiddiq radiyallahu ‘anhu"],
            ["Sirah", "Umar bin Khattab"],
            ["Sirah", "Utsman bin Affan"],
            ["Sirah", "Ali bin Abi Thalib"],
            ["Sirah", "Zabir bin Abdullah"],
            ["Sirah", "Zaid bin Tsabit"],
            ["Sirah", "Abdullah bin Abbas"],
            ["Sirah", "Abdullah bin Umar"],
            ["Sirah", "Ali bin Abi Thalib"],
            ["Sirah", "Haasan dan Husain"],
            ["Sirah", "Anas bin Malik’Habib bin Zaid"],
            ["Sirah", "Abdullah bin Zubair’Usamah bin Zaid"],
            ["Sirah", "Thalhah bin ubaidillah"],
            ["Sirah", "Zubair bin Awwan"],
            ["Sirah", "Abdurrahman bin ‘Auf"],
            ["Sirah", "Sa’ad bin Abi Waqqash"],
            ["Sirah", "Sa’id bin Zaid"],
            ["Sirah", "Abu Ubaidah bin Zarrah"],
            ["Sirah", "Khadijah"],
            ["Sirah", "Aisyah"],
            ["Sirah", "Fatimah"],
            ["Sirah", "Ummu Aiman"],
            ["Sains", "DIISI SENDIRI"]
        ];
        
        foreach($dataMaster as $row){
            RppmdiniyahMaster::create([
                'materi'    => $row[0],
                'kegiatan'  => $row[1],
            ]);
        }

        $raportTkMaster = [
            ['Hadist', 'Niat'],
            ['Hadist', 'Taqwa'],
            ['Hadist', 'Rukun Islam'],
            ['Hadist', 'Urgensi Shahadah'],
            ['Hadist', 'Berkata Baik atau Diam'],
            ['Hadist', 'Larangan Marah'],
            ['Hadist', 'Akhlaq Mulia'],
            ['Hadist', 'Mempelajari Al-Qur\'an'],
            ['Hadist', 'Jagalah Allah'],
            ['Hadist', 'Meminta kepada Allah'],
            ['Hadist', 'Rukun Iman'],
            ['Hadist', 'Hamba yang Dicintai Allah'],
            ['Hadist', 'Orang yang Dikehendaki Kebaikan untuk Allah'],
            ['Hadist', 'Larangan Membahayakan Orang Lain'],
            ['Hadist', 'Mencintai Saudara'],
            ['Hadist', 'Golongan yang Menang'],
            ['Hadist', 'Amalan Utama'],
            ['Hadist', 'Meninggalkan yang Tidak Bermanfaat'],
            ['Hadist', 'Allah Mahabaik'],
            ['Hadist', 'Hasit Malu'],
            ['Doa', 'Sebelum Tidur'],
            ['Doa', 'Bangun Tidur'],
            ['Doa', 'Untuk Kedua Orang Tua'],
            ['Doa', 'Menambah Ilmu'],
            ['Doa', 'Masuk dan Keluar Kamar Mandi'],
            ['Doa', 'Sebelum Makan'],
            ['Doa', 'Apabila Lupa Membaca Doa Sebelum Makan'],
            ['Doa', 'Sesudah Makan'],
            ['Doa', 'Memakai Baju'],
            ['Doa', 'Memakai Baju Baru'],
            ['Doa', 'Masuk Rumah'],
            ['Doa', 'Keluar Rumah'],
            ['Doa', 'Ketika Bersin'],
            ['Doa', 'Dzikir Sebelum Tidur (Ayat Kursi)'],
            ['Doa', 'Dzikir Bangun Tidur'],
            ['Doa', 'Bagi Orang yang Berbuat Baik kepada Kita'],
            ['Doa', 'Ketika Turun Hujan'],
            ['Doa', 'Ketika Berhenti Hujan'],
            ['Doa', 'Mendengar Halilintar'],
            ['Doa', 'Naik Kendaraan'],
            ['Doa', 'Sebelum dan Setelah Wudhu'],
            ['Doa', 'Masuk Masjid'],
            ['Doa', 'Ketika Mendengar Adzan'],
            ['Doa', 'Keberkahan Bagi Orang Lain'],
            ['Doa', 'Memohon Kebaikan Dunia Akhirat'],
            ['Doa', 'Memohon Diperbaiki Urusan Dunia dan Akhirat']
        ];
        
        
        foreach($raportTkMaster as $row){
            RaportTKMaster::create([
                'materi'    => $row[0],
                'submateri' => $row[1],
            ]);
        }


        $dataRaportMid = [
            ['Agama', 'Aqidah', 'Mengenal Allah', 'Mengetahui agama yang dianutnya'],
            ['Agama', 'Aqidah', 'Mengenal Agama Islam', 'Meniru gerakan beribadah dengan urutan yang benar'],
            ['Agama', 'Aqidah', 'Mengenal Nabi Muhammad ﷺ', 'Mengucapkan doa sebelum dan/atau sesudah melakukan sesuatu'],
            ['Agama', 'Aqidah', 'Makna Liya\'buduun', 'Mengenal perilaku baik/sopan dan buruk'],
            ['Agama', 'Aqidah', 'Makna Laa ilaaha illallaah', 'Membiasakan diri berperilaku baik'],
            ['Agama', 'Fiqih', 'Wudhu', ''],
            ['Agama', 'Fiqih', 'Tayammum', ''],
            ['Agama', 'Adab', 'Adab dan akhlaq terhadap diri sendiri', ''],
            ['Agama', 'Adab', 'Adab tidur', ''],
            ['Agama', 'Adab', 'Adab bangun tidur', ''],
            ['Agama', 'Adab', 'Adab dan akhlaq terhadap orangtua', ''],
            ['Agama', 'Adab', 'Adab dan akhlaq terhadap guru', ''],
            ['Agama', 'Adab', 'Adab dan akhlaq terhadap teman', ''],
            ['Agama', 'Adab', 'Adab makan dan minum', ''],
            ['Agama', 'Adab', 'Adab di kamar mandi', ''],
            ['Agama', 'Adab', 'Adab dan akhlaq terhadap binatang', ''],
            ['Agama', 'Hadist', 'Hadits niat', ''],
            ['Agama', 'Hadist', 'Hadits taqwa', ''],
            ['Agama', 'Hadist', 'Hadits rukun Islam', ''],
            ['Agama', 'Hadist', 'Hadits urgensi sholat', ''],
            ['Agama', 'Hadist', 'Hadits berkata baik atau diam', ''],
            ['Agama', 'Hadist', 'Doa untuk orangtua', ''],
            ['Agama', 'Hadist', 'Doa menambah ilmu', ''],
            ['Agama', 'Hadist', 'Doa sebelum dan bangun tidur', ''],
            ['Agama', 'AlQuran', 'Al-Fatihah', ''],
            ['Agama', 'AlQuran', 'An-Naas', ''],
            ['Agama', 'AlQuran', 'Al-Falaq', ''],
            ['Agama', 'AlQuran', 'Al-Ikhlash', ''],
            ['Agama', 'AlQuran', 'Al-Lahab', ''],
            ['Agama', 'AlQuran', 'An-Nashr', ''],
            ['Agama', 'AlQuran', 'Al-Kaafiruun', ''],
            ['Agama', 'AlQuran', 'Al-Kautsar', ''],
            ['Agama', 'AlQuran', 'Al-Maa\'uun', ''],
            ['Agama', 'AlQuran', 'Quraisy', ''],
            ['Agama', 'AlQuran', 'Al-Fiil', ''],
            ['Agama', 'AlQuran', 'Al-Humazah', ''],
            ['Agama', 'AlQuran', 'Al-\'Ashr', ''],
            ['Agama', 'Arab', 'Tema diri sendiri', ''],
            ['Agama', 'Arab', 'Tema Negaraku', ''],
            ['Agama', 'Arab', 'Tema Lingkunganku', ''],
            ['Agama', 'Nabi', 'Nabi Adam   عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Idris عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Nuh عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Hud عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Shalih  عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Ibrahim  عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Luth  عليه السلام', ''],
            ['Agama', 'Nabi', 'Nabi Ismail  عليه السلام', ''],
            ['Fisik Motorik', 'Motorik Kasar', 'Melakukan gerakan tubuh secara terkoordinasi untuk melatih kelenturan, keseimbangan dan kelincahan', ''],
            ['Fisik Motorik', 'Motorik Kasar', 'Melakukan koordinasi gerakan mata-kaki-tangan- kepala dalam menirukan  senam', ''],
            ['Fisik Motorik', 'Motorik Kasar', 'Melakukan permainan fisik dengan aturan', ''],
            ['Fisik Motorik', 'Motorik Kasar', 'Terampilan melakukan tangan kanan dan kiri', ''],
            ['Fisik Motorik', 'Motorik Kasar', 'Melakukan kegiatan kebersihan diri', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Menggambar sesuai gagasannya', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Meniru bentuk', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Melakukan eksplorasi dengan berbagai media dan kegiatan', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Menggunakan alat tulis dan alat makan dengan benar', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Menggunting sesuai dengan pola', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Menempel gambar dengan tepat', ''],
            ['Fisik Motorik', 'Motorik Halus', 'Mengekspresikan diri melalui gerakan menggambar secara rinci', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Berat badan sesuai tingkat usia', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Tinggi badan sesuai tingkat usia', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Berat badan sesuai dengan standar tinggi badan', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Lingkar kepala sesuai tingkat usia', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Menutup hidung dan mulut ( misal ketika batuk dan bersin )', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Membersihkan dan membereskan tempat bermain', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Mengetahui situasi yang membahayakan diri', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Mengetahui tata cara menyeberang', ''],
            ['Fisik Motorik', 'Kesehatan dan Perilaku Keselamatan', 'Mengenal kebiasaan buruk bagi kesehatan  ( rokok, minuman keras )', ''],
            ['Kognitif', 'Belajar dan Pemecahan Masalah', 'Menunjukkan aktivitas yang bersifat eksploratif dan menyelidik (seperti: apa yang terjadi ketika air ditumpahkan)', ''],
            ['Kognitif', 'Belajar dan Pemecahan Masalah', 'Memecahkan masalah sederhana dalam kehidupan sehari hari dengan cara yang fleksibel dan diterima sosial', ''],
            ['Kognitif', 'Belajar dan Pemecahan Masalah', 'Menerapkan pengetahuan atau pengalaman dalam konteks yang baru', ''],
            ['Kognitif', 'Belajar dan Pemecahan Masalah', 'Menunjukkan sikap kreatif dalam menyelesaikan masalah (ide, gagasan di luar kebiasaan)', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengenal perbedaan berdasarkan ukuran : "lebih dari", "kurang dari", dan "paling/ter"', ''],
            ['Kognitif', 'Berpikir Logis', 'Menunjukkan inisiatif dalam memilih tema permainan', ''],
            ['Kognitif', 'Berpikir Logis', 'Menyusun perencanaan kegiatan yang akan dilakukan', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengenal sebab akibat tentang lingkungannya', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengklasifikasikan benda berdasarkan warna, bentuk, dan ukuran ( 3 variasi )', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengklasifikasikan benda yang lebih banyak ke dalam kelompok yang sama atau kelompok yang sejenis atau kelompok berpasangan yang lebih dari 2 variasi', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengenal pola ABCD-ABCD', ''],
            ['Kognitif', 'Berpikir Logis', 'Mengurutkan benda berdasarkan ukuran dari paling kecil ke paling besar atau sebaliknya', ''],
            ['Kognitif', 'Berpikir Simbolik', 'Menyebutkan lambang bilangan 1-10', ''],
            ['Kognitif', 'Berpikir Simbolik', 'Menggunakan lambang bilangan untuk menghitung', ''],
            ['Kognitif', 'Berpikir Simbolik', 'Mencocokkan bilangan dengan lambang bilangan', ''],
            ['Kognitif', 'Berpikir Simbolik', 'Mengenal berbagai macam lambang huruf vokal dan konsonan', ''],
            ['Kognitif', 'Berpikir Simbolik', 'Merepresentasikan berbagai macam benda dalam bentuk gambar atau tulisan', ''],
            ['Bahasa', 'Memahami Bahasa', 'Mengerti beberapa perintah secara bersamaan', ''],
            ['Bahasa', 'Memahami Bahasa', 'Mengulang kalimat yang lebih kompleks', ''],
            ['Bahasa', 'Memahami Bahasa', 'Memahami aturan dalam suatu permainan', ''],
            ['Bahasa', 'Memahami Bahasa', 'Senang dan menghargai bacaan', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Menjawab pertanyaan yang lebih kompleks', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Menyebutkan kelompok gambar yang memiliki bunyi yang sama', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Berkomunikasi secara lisan, memiliki perbendaharaan kata, serta mengenal simbol simbol untuk persiapan membaca, menulis dan berhitung', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Menyusun kalimat sederhana dalam struktur lengkap (pokok kalimat-predikat-keterangan)', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Memiliki lebih banyak kata kata untuk mengekspresikan ide pada orang lain', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Melanjutkan sebagian cerita/dongeng yang telah diperdengarkan', ''],
            ['Bahasa', 'Mengungkapkan Bahasa', 'Menunjukkan pemahaman konsep konsep dalam buku cerita', ''],
            ['Bahasa', 'Keaksaraan', 'Mengenal simbol simbol huruf yang dikenal', ''],
            ['Bahasa', 'Keaksaraan', 'Mengenal suara huruf awal dari nama benda benda yang ada di sekitarnya', ''],
            ['Bahasa', 'Keaksaraan', 'Menyebutkan kelompok gambar yang memiliki bunyi yang sama', ''],
            ['Bahasa', 'Keaksaraan', 'Memahami hubungan antara bunyi dan bentuk huruf', ''],
            ['Bahasa', 'Keaksaraan', 'Membaca nama sendiri', ''],
            ['Bahasa', 'Keaksaraan', 'Menuliskan nama sendiri', ''],
            ['Bahasa', 'Keaksaraan', 'Memahami arti kata dalam cerita', ''],
            ['Bahasa', 'Bahasa Inggris', 'Tema diri sendiri', ''],
            ['Bahasa', 'Bahasa Inggris', 'Tema Negaraku', ''],
            ['Bahasa', 'Bahasa Inggris', 'Tema Lingkunganku', ''],
            ['Sosial Emosional', 'Kesadaran Diri', 'Memperlihatkan kemampuan diri untuk menyesuaikan dengan situasi', ''],
            ['Sosial Emosional', 'Kesadaran Diri', 'Memperlihatkan kehati-hatian kepada orang yang belum dikenal ', ''],
            ['Sosial Emosional', 'Kesadaran Diri', 'Mengenal perasaan sendiri dan mengelolanya secara wajar', ''],
            ['Sosial Emosional', 'Rasa Tanggungjawab Diri Sendiri dan Orang lain', 'Tahu akan haknya', ''],
            ['Sosial Emosional', 'Rasa Tanggungjawab Diri Sendiri dan Orang lain', 'Mentaati aturan kelas (kegiatan, aturan)', ''],
            ['Sosial Emosional', 'Rasa Tanggungjawab Diri Sendiri dan Orang lain', 'Mengatur diri sendiri', ''],
            ['Sosial Emosional', 'Rasa Tanggungjawab Diri Sendiri dan Orang lain', 'Bertanggung jawab atas perilakunya untuk kebaikan diri sendiri', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Bermain dengan teman sebaya', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Mengetahui perasaan temannya dan merespon secara wajar', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Berbagi dengan orang lain', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Menghargai hak/pendapat/karya orang lain', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Menggunakan cara yang diterima secara sosial dalam menyelesaikan masalah', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Bersikap kooperatif dengan teman', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Menunjukkan sikap toleran', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Mengekspresikan emosi yang sesuai dengan kondisi yang ada (senang, sedih, antusias dsb)', ''],
            ['Sosial Emosional', 'Perilaku Prososial', 'Mengenal tata krama dan sopan santun sesuai dengan nilai sosial budaya setempat.', ''],
            ['Seni', 'Seni', 'Bermain drama sederhana', ''],
            ['Seni', 'Seni', 'Menggambar berbagai macam bentuk yang beragam', ''],
            ['Seni', 'Seni', 'Melukis dengan berbagai objek', ''],
            ['Seni', 'Seni', 'Membuat karya seperti bentuk sesungguhnya dengan berbagai bahan (kertas, plastisin, balok dll)', '']
        ];
        
        foreach($dataRaportMid as $item){
            RaportMidTKMaster::create([
                'kategori'      => $item[0],
                'subkategori'   => $item[1],
                'materi'        => $item[2],
                'tujuan'        => $item[3],
            ]);
        }

    }
}
