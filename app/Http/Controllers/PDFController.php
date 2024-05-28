<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Alamat;
use App\Models\Campu;
use App\Models\Document;
use App\Models\Semester;
use App\Models\Room;
use App\Models\Mapel;
use App\Models\Ppdb;
use App\Models\Prestasi;
use App\Models\Register;
use App\Models\Score;
use App\Models\Student;
use App\Models\User;
// use BaconQrCode\Encoder\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function pdfAbsen(Request $request)
    {
        $tanggal = $request->rtanggal;
        $mapel = $request->rmapel;
        $kelas = $request->rkelas;
        $campus = $request->rcampus;

        $load = Absen::join('users', 'users.id', '=', 'absens.user_id')
                        ->join('teachers', 'teachers.user_id', '=', 'absens.user_id')
                        ->where('absens.kelas', $kelas)
                        ->where('mapel', $mapel)
                        ->where('tanggal_absen', $tanggal)->first();

        $data = [
            'title'     => 'Laporan Absensi',
            'result'    => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                                ->where('absens.kelas', $kelas)
                                ->where('mapel', $mapel)
                                ->where('tanggal_absen', $tanggal)->get(),
            'kelas'     => Room::where('campus_id', Auth::user()->campus_id)->get(),
            'mapelRow'  => Mapel::where('idmapel', $mapel)->first(),
            'kelasRow'  => Room::where('idkelas', $kelas)->first(),
            'campus'    => Campu::where('idcampus', $campus)->first(),
            'start'     => $tanggal,
            'nip'       => $load->nip,
            'guru'      => $load->first_name,
            'tabel'     => 1,
        ];
        
        $pdf = PDF::loadView('absen.pdf', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan_absensi'.date('Ymd').'.pdf');
        //return view('absen.pdf', $data);
    }

    public function pdfSiswa(Request $request)
    {
        $data = [
            'title'     => 'Data Siswa',
            'result'    => User::where('level', 4)->where('kelas', $request->kelas)
                            ->join('students', 'students.user_id', '=', 'users.id')
                            ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                            ->get(),
            'kelasRow'  => Room::where('idkelas', $request->kelas)->first(),
        ];
        $pdf = PDF::loadView('siswa.pdf', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('data_siswa'.date('Ymd').'.pdf');
        //return view('siswa.pdf', $data);
    }

    /**PDF PPDB */
    public function pdf_PPDB(Request $request)
    {
        $load_public_token = Student::where('user_id', Auth::user()->id)->first();
        $link_validation_qrcode = 'https://iqis.sch.id/ppdb/'.$load_public_token->public_token.'/data_validation';
        $data = [
            'title'     => 'PPBD SMKIT - Yayasan Pendidikan Ibnul Qayyim',
            'user'      => User::findOrFail(Auth::user()->id),
            'student'   => Student::where('user_id', Auth::user()->id)->first(),
            'alamat'    => Alamat::where('user_id', Auth::user()->id)->first(),
            'register'  => Register::where('user_id', Auth::user()->id)->first(),
            'prestasi'  => Prestasi::where('user_id', Auth::user()->id)->get(),
            'qrcode'    => QrCode::size(100)->generate($link_validation_qrcode),
            'doc'       => Document::where('user_id', Auth::user()->id)->first(),
            'ppdb'      => Ppdb::where('user_id', Auth::user()->id)->first(),
        ];
        
        return view('ppdb.pdf', $data);
    }


    public function generate_image()
    {
        $data = [
            'img'   => Document::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.img', $data);
    }

    public function report_nilai_kelas($ta, $semester, $mapel, $kelas)
    {

        $load = Score::join('users', 'users.id', '=', 'scores.siswa_id')
                        ->join('students', 'students.user_id', '=', 'scores.siswa_id')
                        ->where('scores.kelas', $kelas)->where('mapel', $mapel)
                        ->where('semester', $semester)
                        ->where('ta', $ta)->get();
        $nilai = Score::join('users', 'users.id', '=', 'scores.siswa_id')
                        ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')
                        ->join('rooms', 'rooms.idkelas', '=', 'scores.kelas')
                        ->where('scores.kelas', $kelas)->where('mapel', $mapel)
                        ->where('semester', $semester)
                        ->where('ta', $ta)->first();
        $data = [
            'title'     => 'Laporan Nilai Siswa',
            'result'    => $load,
            'nilai'     => $nilai,
            'campus'    => Campu::where('idcampus', $nilai->campus_id)->first(),
        ];
        $pdf = PDF::loadView('nilai.pdfperkelas', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('nilai_siswa_kelas '.$nilai->kode_kelas.'-'.date('Ymd-his').'.pdf');
        //return view('nilai.pdfperkelas', $data);
    }

    public function report_per_siswa($ta, $semester, $kelas, $siswa)
    {
        $user = User::where('id', $siswa)->select('first_name as name', 'campus_id')->first();
        $data = [
            'title'     => 'Laporan Nilai Semester',
            'result'    => Score::where('ta', $ta)->where('semester', $semester)
                            ->where('kelas', $kelas)->where('siswa_id', $siswa)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')
                            ->select('kode_mapel as kode', 'nama_mapel as mapel', 'nilai')
                            ->get(),
            'nilai'     => Score::join('users', 'users.id', '=', 'scores.user_id')
                            ->join('teachers', 'teachers.idtc', '=', 'users.id')
                            ->where('ta', $ta)->where('semester', $semester)
                            ->where('scores.kelas', $kelas)->where('siswa_id', $siswa)
                            ->select('semester', 'ta', 'first_name as guru', 'nip', 'tanggal_penilaian as tanggal')->first(),
            'student'   => Student::where('user_id', $siswa)->select('nisn')->first(),
            'user'      => $user,
            'kelas'     => Room::where('idkelas', $kelas)->select('kode_kelas')->first(),
            'campus'    => Campu::where('idcampus', $user->campus_id)->select('campus_name')->first(),
            
        ];
        $pdf = PDF::loadView('nilai.reportpersiswa', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('nilai_siswa_'.$user->name.'_'.date('Ymd_his').'.pdf');
    }
}

