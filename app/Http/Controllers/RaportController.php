<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RaportController extends Controller
{

    public function index():View
    {
        $data = [
            'title'     => 'Raport Kurikulum Merdeka',
        ];
        return view('raport.km.index', $data);
    }
    
    public function penilaian():View
    {
        $data = [
            'title'         => 'Form Penilaian Raport KM',
        ];
        return view('raport.km.penilaian', $data);
    }

    public function printRaport($id)
    {
        $loadraport = SdNilaiPelajaran::findOrFail($id);
        $loadKelas = SdNilaiPelajaran::join('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')->where('sd_nilai_pelajarans.id', $id)
                    ->select('rooms.idkelas')->first();
        $data = [
            'title'     => 'Raport Kurikulum Merdeka',
            'dataNilai' => SdNilaiPelajaran::leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                                ->leftJoin('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                                ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                ->leftJoin('mapels', 'mapels.idmapel', 'sd_nilai_pelajarans.mapel_id')
                                ->where('users.id', $loadraport->user_id)
                                ->where('sd_nilai_pelajarans.ta', $loadraport->ta)
                                ->where('sd_nilai_pelajarans.semester', $loadraport->semester)
                                ->select('sd_nilai_pelajarans.aspek', 'sd_nilai_pelajarans.kd', 'sd_nilai_pelajarans.nilai', 'sd_nilai_pelajarans.test',
                                'sd_nilai_pelajarans.non_test', 'sd_nilai_pelajarans.tampil', 'nama_mapel', 'mapels.idmapel', 'kompetensi_dasars.deskripsi')->get(),
            'user'      => User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                ->join('campus', 'campus.idcampus', '=', 'users.campus_id')
                                ->join('students', 'students.user_id', '=', 'users.id')
                                ->join('registers', 'registers.user_id', '=', 'users.id')
                                ->join('alamats', 'alamats.user_id', '=', 'users.id')
                                ->where('users.id', $loadraport->user_id)
                                ->select('first_name', 'nis', 'nisn', 'campus_alamat', 'campus_kepsek', 'tingkat', 'kode_kelas', 'campus_name', 'npsn',
                                'gender', 'agama', 'sekolah_asal', 'provinsi', 'kota', 'kec', 'kel', 'jalan', 'niy_kepsek', 'tempat_lahir', 'tanggal_lahir')->first(),
            'wali'      => Wali::where('user_id', $loadraport->user_id)->get(),
            'wali_kelas'=> Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'users.id')
                                ->where('idkelas', $loadKelas->idkelas)
                                ->select('first_name', 'nip', 'niy')->first(),
            'dataRaport'=> $loadraport,
        ];
        return view('raport.km.print', $data);
        //return response()->json($data);
    }
}
