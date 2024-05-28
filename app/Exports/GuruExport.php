<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GuruExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return User::join('teachers', 'teachers.user_id', '=', 'users.id')
                    ->join('alamats', 'alamats.user_id', '=', 'users.id')
                    ->join('school_teachers', 'school_teachers.user_id', '=', 'users.id')
                    ->join('biodata_teachers', 'biodata_teachers.user_id', '=', 'users.id')
                    ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'users.id')
                    ->join('kompetensi_khusus_teachers', 'kompetensi_khusus_teachers.user_id', '=', 'users.id')
                    ->join('penugasan_teachers', 'penugasan_teachers.user_id', '=', 'users.id')
                    ->select(  
                        'nama_sekolah', 'npsn_sekolah', 'alamat_sekolah', 'first_name', 'nik', 
                        'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'ibu_kandung',

                        /**Alamat */
                        'jalan', 'rt', 'rw', 'dusun', 'kel', 'kec', 'kota', 'provinsi', 
                        'lintang', 'bujur', 'kode_pos',

                        /**Biodata Teacher */
                        'kk','npwp', 'agama', 'nama_npwp', 'kewarganegaraan', 'negara', 'status_perkawinan',
                        'nama_pasangan', 'nip_pasangan', 'pekerjaan_pasangan',

                        /**Kepegawaian */
                        'kepegawaian_teachers.status', 'nip', 'niy', 'nuptk', 'jenis_ptk', 'sk_pengangkatan',
                        'tmt_pengangkatan', 'lembaga_pengankat', 'sk_cpns', 'tmt_pns',
                        'golongan', 'sumber_gaji', 'kartu_pegawai', 'karis_karsu',

                        /**Kompetensi Khusus */
                        'punya_lisensi_kepsek', 'nuks', 'keahlian_lab', 'menangani_keb_khusus',
                        'keahlian_braile', 'keahlian_bhs_isyarat',

                        /**Users Kontak */
                        'telephone', 'phone', 'email',

                        /**Penugasan */
                        'nomor_surat_tugas', 'tanggal_surat_tugas', 'tmt_tugas', 'sekolah_induk',
                        'keluar_karena', 'tanggal_keluar', 'uname_akun_ptk', 'pass_akun_ptk',

                        /**Lainlain */
                        'users.level', 'users.kelas',
                    )
                    ->where('users.campus_id', Auth::user()->campus_id)->get();
    }

    /**Heading */
    public function headings(): array
    {
        return [
            'Nama Sekolah', 'NPSN', 'Alamat Sekolah', 'Nama Lengkap', 'NIK',
            'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Nama Ibu Kandung',

            /**Alamat */
            'Nama Jalan', 'RT', 'RW', 'Dusun', 'Kelurahan', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi',
            'Lintang', 'Bujur', 'Kode POS',

            /**Biodata Teacher */
            'Kartu Keluarha', 'NPWP', 'Agama Kepercayaan', 'Nama Wajib Pajak', 'Kewarganegaraan', 'Negara', 'Status Perkawinan',
            'Nama Suami/Istri', 'NIP Suami/Istri', 'Pekerjaan Suami/Istri',

            /**Kepegawaian */
            'Status Kepegawaian', 'NIP', 'NIY/NIGK', 'NUPTK', 'Jenis PTK', 'SK Pengangkatan',
            'TMT Pengangkatan', 'Lembaga Pengangkat', 'SC CPNS', 'TMT PNS', 
            'Pangkat/Golongan', 'Sumber Gaji', 'Kartu Pegawai', 'KARIS/KARSU (Kartu Istri/Suami)',

            /**Kompetensi Khusus */
            'Punya Lisensi Kepala Sekolah', 'Nomor Unik Kepala Sekolah (NUKS)', 'Keahlian Laboratorium',
            'Mampu Menangani Kebutuhan Khusus', 'Keahlian Braile', 'Keahlian Bahasa Isyarat',

            /**Users Kontak */
            'Nomor Telephone Rumah', 'Nomor Handphone', 'Email',

            /**Penugasan */
            'Nomor Surat Tugas', 'Tanggal Surat Tugas', 'TMT Tugas', 'Status Sekolah Induk',
            'Keluar Karena', 'Tanggal Keluar', 'Username Akun PTK', 'Password Akun PTK',

            /**Lain lain */
            'Level Akun SIM', 'Password Akun SIMS',
        ];
    }
}
