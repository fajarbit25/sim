<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return User::where('campus_id', Auth::user()->campus_id)
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->join('alamats', 'alamats.user_id', '=', 'users.id')
                    ->join('priodiks', 'priodiks.user_id', '=', 'users.id')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('documents', 'documents.user_id', '=', 'users.id')
                    ->join('walis as wali_ayah', function ($join) {
                        $join->on('users.id', '=', 'wali_ayah.user_id')
                            ->where('wali_ayah.segment', '=', 'ayah');
                        })
                        ->join('walis as wali_ibu', function ($join) {
                            $join->on('users.id', '=', 'wali_ibu.user_id')
                                ->where('wali_ibu.segment', '=', 'ibu');
                        })
                        ->join('walis as wali_wali', function ($join) {
                            $join->on('users.id', '=', 'wali_wali.user_id')
                                ->where('wali_wali.segment', '=', 'wali');
                        })
                    ->select(
                        'first_name',
                        'gender',
                        'nisn',
                        'students.nik',
                        'students.kk',
                        'tempat_lahir',
                        'tanggal_lahir',
                        'students.akta_lahir',
                        'agama',
                        'kewarganegaraan',
                        'students.no_kks', 'students.anak_ke', 'students.penerima_kps', 'students.nomor_kps', 'students.layak_pip',
                        'students.alasan_layak_pip', 'students.penerima_kip', 'students.no_kip', 'students.nama_kip', 'students.alasan_menolak_kip',
                        'alamats.provinsi', 'alamats.kota', 'alamats.kec', 'alamats.kel', 'alamats.rt',
                        'alamats.rw', 'alamats.jalan', 'alamats.kode_pos', 'alamats.lintang', 'alamats.bujur', 
                        'alamats.status_tempat_tinggal', 'alamats.moda_transportasi',
                        'priodiks.tinggi', 'priodiks.berat', 'priodiks.lingkar_kepala', 'priodiks.jarak_per_1km', 'priodiks.jarak',
                        'priodiks.jam', 'priodiks.menit', 'priodiks.saudara',
                        'registers.jenis', 'registers.sekolah_asal', 'registers.npsn_sekolah', //Data Register

                        'wali_ayah.nama_lengkap', 'wali_ayah.nik as nik_ayah', 'wali_ayah.tahun_lahir', 'wali_ayah.pendidikan', 
                        'wali_ayah.pekerjaan', 'wali_ayah.penghasilan', 'wali_ayah.keb_khusus as keb_khusus_ayah', //Ayah

                        'wali_ibu.nama_lengkap as nama_ibu', 'wali_ibu.nik as nik_ibu', 'wali_ibu.tahun_lahir as tahun_lahir_ibu', 
                        'wali_ibu.pendidikan as pendidikan_ibu', 'wali_ibu.pekerjaan as pekerjaan_ibu', 'wali_ibu.penghasilan as penghasilan_ibu', 
                        'wali_ibu.keb_khusus as keb_khusus_ibu', //Ibu

                        'wali_wali.nama_lengkap as nama_wali', 'wali_wali.nik as nik_wali', 'wali_wali.tahun_lahir as tahun_lahir_wali', 
                        'wali_wali.pendidikan as pendidikan_wali', 'wali_wali.pekerjaan as pekerjaan_wali', 'wali_wali.penghasilan as penghasilan_wali', 
                        'wali_wali.keb_khusus as keb_khusus_wali', //Wali

                        'email', 'phone', 'registers.ipa',  // Data User

                        'documents.akta_lahir as doc_akta', 'documents.kk as doc_kk', 'documents.ktp_ortu', 'photo as doc_foto', //Document

                        'registers.nis', 'registers.nomor_ujian', 'registers.nomor_ijazah', 'registers.nomor_skhu', //Register

                    )
                    ->get();

    }

    /**Heading */
    public function headings(): array
    {
        return [
            'Nama',
            'Jenis Kelamin',
            'NISN',
            'NIK',
            'KK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Akta Lahir',
            'Agama',
            'Kewarganegaraan',
            'Nomor KKS',
            'Anak ke',
            'Penerima KPS',
            'Nomor KPS',
            'Layak PIP',
            'Alasan Layak PIP',
            'Penerima KIP',
            'Nomor KIP',
            'Nama KIP',
            'Alasan Menolak KIP',
            'Provinsi',
            'Kota',
            'Kecamatan',
            'Kelurahan',
            'RT',
            'RW',
            'Jalan',
            'Kode Pos',
            'Lintang',
            'Bujur',
            'Status Tempat Tinggal',
            'Moda Transportasi',
            'Tinggi',
            'Berat',
            'Lingkar Kepala',
            'Jarak per 1km',
            'Jarak',
            'Jam',
            'Menit',
            'Jumlah Saudara',
            'Jenis Registrasi',
            'Sekolah Asal',
            'NPSN Sekolah',
            'Nama Ayah',
            'NIK Ayah',
            'Tahun Lahir Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'Kebutuhan Khusus Ayah',
            'Nama Ibu',
            'NIK Ibu',
            'Tahun Lahir Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'Kebutuhan Khusus Ibu',
            'Nama Wali',
            'NIK Wali',
            'Tahun Lahir Wali',
            'Pendidikan Wali',
            'Pekerjaan Wali',
            'Penghasilan Wali',
            'Kebutuhan Khusus Wali',
            'Akta Lahir',
            'Handphone',
            'Password',
            'Akta Lahir',
            'Kartu Keluarga',
            'KTP',
            'Foto Siswa',
            'NIS',
            'Nomor Ujian',
            'Nomor Ijazah',
            'Nomor SKHU',
        ];
    }
}
