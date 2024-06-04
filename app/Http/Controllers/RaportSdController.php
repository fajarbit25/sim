<?php

namespace App\Http\Controllers;

use App\Models\KompetensiDasar;
use App\Models\Predikat;
use App\Models\Priodik;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RaportSdController extends Controller
{
    public function __construct()
    {
        
    }

    public function kd():View
    {
        $data = [
            'title'     => 'Kompetensi Dasar',
        ];
        return view('raport.sd.kd', $data);
    }

    public function penilaian():View
    {
        $data = [
            'title'     => 'Form Penilaian',
        ];
        return view('raport.sd.penilaian', $data);
    }

    public function raport():view
    {
        $data = [
            'title'     => 'Rapor Siswa',
        ];
        return view('raport.sd.index', $data);
    }

    public function raportCetak($id)
    {
        $load = SdNilaiPelajaran::join('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                                ->join('campus', 'campus.idcampus', '=', 'users.campus_id')
                                ->join('students', 'students.user_id', '=', 'users.id')
                                ->join('registers', 'registers.user_id', '=', 'users.id')
                                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                ->select('first_name', 'nick_name', 'campus_name', 'campus_kepsek', 'niy_kepsek', 'npsn',
                                'ta', 'semester', 'sd_nilai_pelajarans.user_id', 'kelas', 'campus_alamat', 'nisn', 'nis',
                                'tingkat', 'kode_kelas', 'campus_kepsek', 'rooms.idkelas', 'tanggal_raport')
                                ->where('sd_nilai_pelajarans.id', $id)->first();
        $data = [
            'title'         => 'Raport Semester',
            'dataNilai'     => SdNilaiPelajaran::leftJoin('mapels', 'mapels.idmapel', '=', 'sd_nilai_pelajarans.mapel_id')
                                    ->leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                                    ->leftJoin('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                                    ->where('sd_nilai_pelajarans.ta', $load->ta)
                                    ->where('sd_nilai_pelajarans.semester', $load->semester)
                                    ->where('sd_nilai_pelajarans.user_id', $load->user_id)
                                    ->select('users.id as iduser', 'first_name', 'nick_name', 'nilai', 'mapel_id',
                                    'nama_mapel', 'sd_nilai_pelajarans.id as idraport', 'kd', 'mapels.jenis')
                                    ->get(),
            'load'          => $load,
            'dataCapaian'   => Predikat::where('campus_id', Auth::user()->campus_id)
                                    ->where('jenis', 'Capaian')->get(),
            'dataKd'        => KompetensiDasar::where('aspek', 'Formatif')->get(),
            'room'          => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                ->where('idkelas', $load->idkelas)->select('first_name as wali_kelas')
                                ->first(),
            'priodik'       => Priodik::where('user_id', $load->user_id)->orderBy('created_at', 'DESC')->first(),
        ];
        return view('raport.sd.print', $data);
    }
}
