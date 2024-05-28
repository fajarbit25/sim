<?php

namespace App\Imports;

use App\Http\Livewire\Teacher\Kontak;
use App\Models\Alamat;
use App\Models\BiodataTeacher;
use App\Models\KepegawaianTeacher;
use App\Models\KompetensiKhususTeacher;
use App\Models\PenugasanTeacher;
use App\Models\SchoolTeacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ImportGuru implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            foreach($collection as $col)
            {
                $user = User::create([
                    'first_name'    => $col[3],
                    'email'         => $col[52],
                    'level'         => $col[61], //level
                    'status'        => 1, //status 1 untuk aktif, o untuk nonaktif
                    'phone'         => $col[51],
                    'telephone'     => $col[50],
                    'photo'          => 'https://sim.iqis.sch.id/storage/photo-users/user.png', //nama file foto user
                    'campus_id'     => Auth::user()->campus_id,
                    'email_verified_at'=> date('Y-m-d'),
                    'kelas'         => 0,
                    'password'      => Hash::make($col[62]),
                    'rfid'          => NULL,      
                ]);

                Teacher::create([
                    'user_id'       => $user->id,
                    'jenis_kelamin' => $col[5],
                    'tempat_lahir'  => $col[6],
                    'tanggal_lahir' => $col[7],
                    'nik'           => $col[4],
                    'kk'            => $col[20],
                    'ibu_kandung'   => $col[8],
                    ]);

                SchoolTeacher::create([
                    'user_id'       => $user->id,
                    'nama_sekolah'  => $col[0],
                    'npsn_sekolah'  => $col[1],
                    'alamat_sekolah'=> $col[2],
                ]);

                Alamat::create([
                    'user_id'           => $user->id,
                    'provinsi'          => $col[16],
                    'kota'              => $col[15],
                    'kec'               => $col[14],
                    'kel'               => $col[13],
                    'dusun'             => $col[12],
                    'rt'                => $col[10],
                    'rw'                => $col[11],
                    'kode_pos'          => $col[19],
                    'jalan'             => $col[9],
                    'lintang'           => $col[17],
                    'bujur'             => $col[18],
                ]);

                BiodataTeacher::create([
                    'user_id'           => $user->id,
                    'kk'                => $col[20],
                    'agama'             => $col[22],
                    'npwp'              => $col[21],
                    'nama_npwp'         => $col[23],
                    'kewarganegaraan'   => $col[24],
                    'negara'            => $col[25],
                    'status_perkawinan' => $col[26],
                    'nama_pasangan'     => $col[27],
                    'nip_pasangan'      => $col[28],
                    'pekerjaan_pasangan'=> $col[29],
                ]);

                KepegawaianTeacher::create([
                    'user_id'           => $user->id,
                    'status'            => $col[30],
                    'nip'               => $col[31],
                    'niy'               => $col[32],
                    'nuptk'             => $col[33],
                    'jenis_ptk'         => $col[34],
                    'sk_pengangkatan'   => $col[35],
                    'tmt_pengangkatan'  => $col[36],
                    'lembaga_pengankat' => $col[37],
                    'sk_cpns'           => $col[38],
                    'tmt_pns'           => $col[39],
                    'golongan'          => $col[40],
                    'sumber_gaji'       => $col[41],
                    'kartu_pegawai'     => $col[42],
                    'karis_karsu'       => $col[43],
                ]);

                KompetensiKhususTeacher::create([
                    'user_id'               => $user->id,
                    'punya_lisensi_kepsek'  => $col[44],
                    'nuks'                  => $col[45],
                    'keahlian_lab'          => $col[46],
                    'menangani_keb_khusus'  => $col[47],
                    'keahlian_braile'       => $col[48],
                    'keahlian_bhs_isyarat'  => $col[49],
                ]);

                PenugasanTeacher::create([
                    'user_id'               => $user->id,
                    'nomor_surat_tugas'     => $col[53],
                    'tanggal_surat_tugas'   => $col[54],
                    'tmt_tugas'             => $col[55],
                    'sekolah_induk'         => $col[56],
                    'keluar_karena'         => $col[57],
                    'tanggal_keluar'        => $col[58],
                    'uname_akun_ptk'        => $col[59],
                    'pass_akun_ptk'         => $col[60],

                ]);
            }
            return redirect('/guru')->with(['success' => 'Data berhasil diimport..']);

        }  catch (QueryException $e){

            Log::error('Info error : ' . $e->getMessage());

            return Redirect::back()->withErrors(['error' => 'Periksa pengisian kolom tabel anda. '.$e->getMessage()]);
        }

        
    }
        
    
}

