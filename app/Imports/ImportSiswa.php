<?php

namespace App\Imports;

use App\Models\Alamat;
use App\Models\Document;
use App\Models\Ppdb;
use App\Models\Priodik;
use App\Models\Register;
use App\Models\User;
use App\Models\Student;
use App\Models\Wali;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ImportSiswa implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col)
        {
            $user = User::create([
                'first_name'    => $col[0],
                'email'         => $col[64],
                'level'         => 4, //level untuk siswa
                'status'        => 1, //status 1 untuk aktif, o untuk nonaktif
                'phone'         => $col[65],
                'telephone'     => $col[65],
                'photo'          => 'user.png', //nama file foto user
                'campus_id'     => Auth::user()->campus_id,
                'email_verified_at'=> date('Y-m-d'),
                'kelas'         => 0,
                'password'      => Hash::make($col[66]),
                'rfid'          => NULL,      
            ]);


            $dataStudent = Student::create([
                'user_id'       => $user->id,
                'room_id'       => 0,
                'gender'        => $col[1],
                'nisn'          => $col[2],
                'nik'           => $col[3],
                'kk'            => $col[4],
                'tempat_lahir'  => $col[5],
                'tanggal_lahir' => $col[6],
                'akta_lahir'    => $col[7],
                'agama'         => $col[8],
                'kewarganegaraan'=> $col[9],
                'negara'        => 'Indonesia',
                'anak_ke'       => $col[11],
                'pekerjaan_pelajar'=> '-',
                'penerima_kip'  => $col[16],
                'no_kip'        => $col[17],
                'nama_kip'      => $col[18],
                'alasan_menolak_kip'=> $col[19],
                'no_kks'        => $col[10],
                'penerima_kps'  => $col[12],
                'nomor_kps'     => $col[13],
                'layak_pip'     => $col[14],
                'alasan_layak_pip'=> $col[15],
                'public_token'  => rand(0, strlen('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') -1),
            ]);

            


            $alamat = [
                'user_id'               => $user->id,
                'provinsi'              => $col[20],
                'kota'                  => $col[21],
                'kec'                   => $col[22],
                'kel'                   => $col[23],
                'rt'                    => $col[24],
                'rw'                    => $col[25],
                'kode_pos'              => $col[27],
                'jalan'                 => $col[26],
                'status_tempat_tinggal' => $col[30],
                'moda_transportasi'     => $col[31],
                'lintang'               => NULL,
                'bujur'                 => NULL,
            ];
    
            $document = [
                'user_id'       => $user->id,
                'akta_lahir'    => $col[67],
                'kk'            => $col[68],
                'ktp_ortu'      => $col[69],
                'ktp'           => NULL,
                'foto'          => $col[70],
                'updated_by'    => $user->id,
            ];
            Document::create($document);
    
            $ayah = [
                'user_id'               => $user->id,
                'segment'               => 'ayah',
                'nama_lengkap'          => $col[43],
                'nik'                   => $col[44],
                'tahun_lahir'           => $col[45],
                'pendidikan'            => $col[46],
                'pekerjaan'             => $col[47],
                'penghasilan'           => $col[48],
                'keb_khusus'            => NULL,
            ];
            $ibu = [
                'user_id'               => $user->id,
                'segment'               => 'ibu',
                'nama_lengkap'          => $col[50],
                'nik'                   => $col[51],
                'tahun_lahir'           => $col[52],
                'pendidikan'            => $col[53],
                'pekerjaan'             => $col[54],
                'penghasilan'           => $col[55],
                'keb_khusus'            => NULL,
            ];
            $wali = [
                'user_id'               => $user->id,
                'segment'               => 'wali',
                'nama_lengkap'          => $col[57],
                'nik'                   => $col[58],
                'tahun_lahir'           => $col[59],
                'pendidikan'            => $col[60],
                'pekerjaan'             => $col[61],
                'penghasilan'           => $col[62],
                'keb_khusus'            => NULL,
            ];
            Wali::create($ayah);
            Wali::create($ibu);
            Wali::create($wali);
    
            $priodik = [
                'user_id'               => $user->id,
                'tinggi'                => $col[32],
                'berat'                 => $col[33],
                'lingkar_kepala'        => $col[34],
                'jarak_per_1km'         => $col[35],
                'jarak'                 => $col[36],
                'jam'                   => $col[37],
                'menit'                 => $col[32],
                'saudara'               => $col[39],
            ];
            Priodik::create($priodik);
            
            $register = [
                'user_id'       => $user->id,
                'kompetensi'    => NULL,
                'jenis'         => $col[40],
                'nis'           => $col[71],
                'tanggal_masuk' => NULL,
                'sekolah_asal'  => $col[41],
                'npsn_sekolah'  => $col[42],
                'nomor_ujian'   => $col[72],
                'nomor_ijazah'  => $col[73],
                'nomor_skhu'    => $col[74],
                'bahasa_indonesia'=> NULL,
                'matematika'    => NULL,
                'ipa'           => NULL,
            ];
            Register::create($register);

            Alamat::create($alamat);

            $dataPpbd = [
                'user_id'           => $user->id,
                'nomor_pendaftaran' => time(),
                'lokasi_pendaftaran'=> 'Sekolah',
                'nomor_formulir'    => '-',
                'jalur'             => 'Zonasi',
                'jenjang'           => '-',
                'status'            => 200,
            ];
            Ppdb::create($dataPpbd);

        }
    }
}

