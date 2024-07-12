<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Raport\Km\Tahsin;
use App\Models\Campu;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\TahfidzNilai;
use App\Models\TahsinCatatan;
use App\Models\TahsinGuru;
use App\Models\TahsinNilai;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\TahfidzFaturrahman;
use IntlDateFormatter;

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

    public function raportTahsin()
    {
        $data = [
            'title'     => 'Penilaian Tahsin',
        ];
        return view('raport.km.tahsin', $data);
    }

    public function raportTahsinAdmin()
    {
        $data = [
            'title'     => 'Penilaian Tahsin',
        ];
        return view('raport.km.tahsin-admin', $data);
    }

    public function raportTahsinPrint($id): View
    {
        $load = TahsinNilai::findOrFail($id);
        $siswa = User::where('id', $load->user_id)->select('first_name')->first();
        $data = [
            'title'         => 'Raport Tahsin',
            'tahsin'        => TahsinNilai::join('tahsin_kds', 'tahsin_kds.id', '=', 'tahsin_nilais.kd_id')
                                    ->where('tahsin_nilais.ta', $load->ta)->where('tahsin_nilais.semester', $load->semester)
                                    ->where('tahsin_nilais.kelas', $load->kelas)->where('tahsin_nilais.user_id', $load->user_id)
                                    ->select('kd_id', 'bahasa', 'nilai', 'kkm', 'arabic')
                                    ->get(),
            'catatan'       => TahsinCatatan::where('ta', $load->ta)->where('semester', $load->semester)
                                    ->where('kelas', $load->kelas)->where('user_id', $load->user_id)
                                    ->select('catatan')->first(),
            'semester'      => $load->semester,
            'ta'            => $load->ta,
            'siswa'         => $siswa,
            'kelas'         => Room::findOrFail($load->kelas),
            'guru1'         => TahsinGuru::join('users', 'users.id', '=', 'tahsin_gurus.user_id')
                                ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'users.id')
                                ->select('first_name', 'niy')->first(),
            'guru2'         => TahsinGuru::join('users', 'users.id', '=', 'tahsin_gurus.user_id')
                                ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'users.id')
                                ->select('first_name', 'niy')->skip(1)->first(),
            'kepsek'        => Campu::findOrFail(Auth::user()->campus_id),
        ];
        return view('raport.km.tahsin-print', $data);
    }

    public function raportTahfidz(): View
    {
        $data = [
            'title'         => 'Raport Tahfidz',
        ];
        return view('raport.km.tahfidz', $data);
    }

    public function databaseTahfidz(): View
    {
        $data = [
            'title'         => 'Database Surah',
        ];
        return view('raport.km.tahfidz-database', $data);
    }

    public function printTahfidz($id):View
    {
        $raport = TahfidzNilai::findOrFail($id);
        $userid = $raport->user_id;
        $ta = $raport->ta;
        $semester = $raport->semester;
        $kelas = $raport->kelas;
        $campus = Auth::user()->campus_id;

        $saran = TahsinCatatan::where('ta', $ta)->where('semester', $semester)->where('kelas', $kelas)->where('user_id', $userid)->first();
        $tanggal = $saran->tanggal_rapor;
        $tanggalHijriah = Hijri::MediumDate($tanggal);
        $catatan = $saran->catatan;

        $dateTime = new \DateTime($tanggal); // Konversi string tanggal ke objek DateTime

        $formatter = new IntlDateFormatter(
            'id_ID', // Locales untuk bahasa Indonesia
            IntlDateFormatter::LONG, // Format panjang (misalnya: 12 Juli 2024)
            IntlDateFormatter::NONE // Hanya tanggal, tanpa waktu
        );

        $formattedDate = $formatter->format($dateTime);

        $data = [
            'title'         => 'Raport Tahfidz',
            'result'        => TahfidzNilai::join('tahfidz_surahs', 'tahfidz_surahs.id', '=', 'tahfidz_nilais.id_surah')
                                ->where('tahfidz_nilais.ta', $ta)->where('tahfidz_nilais.semester', $semester)
                                ->where('tahfidz_nilais.kelas', $kelas)->where('tahfidz_nilais.user_id', $userid)
                                ->where('tahfidz_nilais.campus_id', $campus)
                                ->select('tahfidz_nilais.id','tahfidz_nilais.user_id', 'bahasa', 'nilai', 'jus')->get(),
            'hijriah'       => $tanggalHijriah,
            'masehi'        => $formattedDate,
            'campus'        => Campu::findOrFail(Auth::user()->campus_id),
            'semester'      => $semester,
            'ta'            => $ta,
            'kelas'         => Room::findOrFail($kelas),
            'user'          => User::join('students', 'students.user_id', '=', 'users.id')
                                ->where('users.id', $userid)->select('first_name', 'nisn')->first(),
            'faturrahman'   => TahfidzFaturrahman::where('ta', $ta)->where('semester', $semester)
                                ->where('kelas', $kelas)->where('user_id', $userid)->where('campus_id', $campus)
                                ->select('deskripsi', 'nilai')->first(),
            'catatan'       => $catatan,
            'guru_tahsin'   => TahsinGuru::join('users', 'users.id', '=', 'tahsin_gurus.user_id')
                                ->where('tahsin_gurus.kelas', $kelas)
                                ->where('tahsin_gurus.campus_id', Auth::user()->campus_id)->select('first_name as name')->first(),
        ];
        return view('raport.km.tahfidz-print', $data);
    }
}
