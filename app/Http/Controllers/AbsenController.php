<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use App\Models\AbsenApi;
use App\Models\Activity;
use App\Models\Campu;
use App\Models\Gurulog;
use App\Models\Gurumapel;
use App\Models\Semester;
use App\Models\Room;
use App\Models\Mapel;
use App\Models\Siswalog;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**Absen Siswa */
    public function index():view
    {
        $data = [
            'title'     => 'Form Absensi Wali Kelas',
        ];
        return view('absen.index', $data);
    }

    public function report(): View
    {
        $data = [
            'title'     => 'Laporan Absensi Siswa',
        ];
        return view('absen.report', $data);
    }


    /**Absen Guru */
    public function absenGuru(): View
    {
        $data = [
            'title'     => 'Absensi Guru & Staff',
        ];
        return view('absen.guru.index', $data);
    }

    /**Absen Guru */
    public function absenMapel(): View
    {
        $data = [
            'title'     => 'Absensi Mata Pelajaran',
        ];
        return view('absen.absen-mapel', $data);
    }

    public function absenMapelreport()
    {
        $data = [
            'title'     => 'Absensi Mata Pelajaran',
        ];
        return view('absen.absen-mapel-report', $data);
    }

    public function absenGuruToday() : View
    {
        $data = [
            'result'    => AbsenApi::join('users', 'users.id', '=', 'absen_apis.user_id')
                            ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'absen_apis.user_id')
                            ->where('absen_apis.campus_id', Auth::user()->campus_id)
                            ->where('tanggal', date('Y-m-d'))
                            ->select('first_name as name', 'nip', 'level', 'jam_masuk', 'jam_pulang', 'photo')
                            ->get(),
        ];
        return view('absen.guru.today', $data);
    }

}
