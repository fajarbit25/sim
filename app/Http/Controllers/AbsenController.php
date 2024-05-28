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
    public function __construct()
    {
        $this->middleware('guru');
        //$this->middleware('proses');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//:view
    {
        //cek absen aktif
        $cek = Absen::where('user_id', Auth::user()->id)->where('status', 'open')->count();
        
        if($cek == 0){
            $idcampus = Auth::user()->campus_id;
            $data = [
                'title'     => 'Absen',
                'kelas'     => Room::where('campus_id', $idcampus)->get(),
                'mapel'     => Gurumapel::where('user_id', Auth::user()->id)->join('mapels', 'mapels.idmapel', '=', 'mapel_id')->get(), 
                'semester'  => Semester::where('is_active', 'true')->first(),
            ];
            return view('absen.index', $data);
        }else{
            return redirect('/absensi')->with(['success', 'Masih ada absensi belum selesai']);  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'semester'      => 'required',
            'tanggal_absen' => 'required',
            'kelas'         => 'required',
            'mapel'         => 'required',
        ]);

        $cek = Absen::where('kelas', $request->kelas)->where('tanggal_absen', $request->tanggal_absen)
                        ->where('mapel', $request->mapel)->count();
        if($cek != 0){
            return redirect('/absen')->with(['warning' => 'Absensi seluruh siswa telah melakukan absensi!']);
        }

        //data
        $kode_absen = date('Ymdhis');
        $kelas = $request->kelas;

        /**Store Log Guru */
        $loadMapel = Mapel::where('idmapel', $request->mapel)->first();
        $mapelName = $loadMapel->nama_mapel;
        Gurulog::create([
            'user_id'       => Auth::user()->id,
            'kelas_id'      => $kelas,
            'tanggal'       => date('Y-m-d'),
            'jam'           => date('H:i'),
            'keterangan'    => 'Masuk Pelajaran '.$mapelName,
        ]);

        //mengambil data siswa dari kelas
        $load = User::where('kelas', $kelas)->where('level', 4)->get();
        $data = array();

        //looping
        foreach($load as $ld){
            $data[] = Absen::create([
                'kode_absen'        => $kode_absen,
                'semester'          => $request->semester,
                'kelas'             => $request->kelas,
                'mapel'             => $request->mapel,
                'user_id'           => Auth::user()->id,
                'siswa_id'          => $ld->id,
                'absensi'           => 'Hadir',
                'keterangan'        => 'OK',
                'tanggal_absen'     => date('Y-m-d'),
                'status'            => 'open',
                'campus_id'         => Auth::user()->campus_id,
            ]);
        }
        return redirect('/absensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):view
    {
        $data = [
            'title'     => 'Laporan Absensi Kelas',
            'absen'     => Absen::where('kode_absen', $id)
                            ->join('students', 'students.user_id', 'absens.siswa_id')
                            ->join('users', 'users.id', '=', 'absens.siswa_id')
                            ->get(),
            'dataAbsen' => Absen::where('kode_absen', $id)->first(),
        ];
        return view('absen.laporan', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //cek absen aktif
        $cek = Absen::where('user_id', Auth::user()->id)->where('status', 'open')->count();
        
        if($cek == 0){
            return redirect('/absensi')->with(['success', 'Masih ada absensi belum selesai']);  
        }else{
            $data = [
                'title'         => 'absensi',
                'dataAbsen'     => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                    ->where('user_id', Auth::user()->id)
                                    ->where('absens.status', 'open')
                                    ->first(),
            ];
            return view('absen.absensi', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        /**Insert Siswa Log */
        $loadAbsen = Absen::where('idabsen', $id)->first();
        Siswalog::create([
            'user_id'   => $loadAbsen->siswa_id,
            'tanggal'   => date('Y-m-d'),
            'jam'       => date('H:i'),
            'tipe'      => 'Masuk',
            'mapel_id'  => $request->mapel,
        ]);


        $data = [
            'absensi'   => $request->absen,
        ];
        Absen::where('idabsen', $id)->update($data);
        


    }

    public function form():view
    {
        $data = [
            'absen'     => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                                ->join('students', 'students.user_id', '=', 'users.id')
                                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                ->where('absens.user_id', Auth::user()->id)
                                ->where('absens.status', 'open')
                                ->get(),
        ];
        return view('absen.form', $data);
    }

    public function formSearch($key):view
    {
        $data = [
            'absen'     => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                                ->join('students', 'students.user_id', '=', 'users.id')
                                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                ->where('absens.user_id', Auth::user()->id)
                                ->where('absens.status', 'open')
                                ->where('users.first_name', 'LIKE', '%'.$key.'%')
                                ->get(),
        ];
        return view('absen.form', $data);
    }

    public function submit(Request $request):RedirectResponse
    {
        $request->validate([
            'kode_absen'    => 'required',
        ]);

        /**Load data absen */
        $absen  = Absen::where('kode_absen', $request->kode_absen)->first();

        /**Insert data activity teacher*/
        $dataActivity = [
            'campus_id'     => Auth::user()->campus_id,
            'room_id'       => $absen->kelas,
            'tanggal'       => date('Y-m-d'),
            'jam'           => date('H:i'),
            'kegiatan'      => 'Proses KBM',
            'user_id'       => Auth::user()->id,
        ];
        Activity::create($dataActivity);

        /**Close absensi */
        Absen::where('kode_absen', $request->kode_absen)->update(['status' => 'close']);
        return redirect('/absen'.'/'.$request->kode_absen.'/show')->with(['success', 'Data berhasil dikirim.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report():view
    {
        $data = [
            'title'     => 'Laporan Absensi',
            'mapel'     => Mapel::all(),
            'kelas'     => Room::all(),
            'campus'    => Campu::all(),
            'tabel'     => 0,
        ];
        return view('absen.report', $data);

    }
    public function tableAbsen($kelas, $mapel, $tanggal, $campus): View
    {
        $data = [
            'result'    => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                                    ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                                    ->where('absens.kelas', $kelas)
                                    ->where('mapel', $mapel)
                                    ->where('absens.campus_id', $campus)
                                    ->where('tanggal_absen', $tanggal)
                                    ->get(),
            'kelas'     => $kelas,
            'mapel'     => $mapel,
            'tanggal'   => $tanggal,
            'campus'    => $campus,
            'mapel_head'=> Mapel::where('idmapel', $mapel)->select('nama_mapel')->first(),
        ];
        return view('absen.tableAbsen', $data);
    }

    public function listAbsen($kelas, $tanggal, $campus)
    {
        $data = [
            'result' => Absen::join('mapels', 'mapels.idmapel', '=', 'absens.mapel')
                                ->join('users', 'users.id', '=', 'absens.user_id')
                                ->where('absens.kelas', $kelas)
                                ->where('absens.campus_id', $campus)
                                ->where('tanggal_absen', $tanggal)
                                ->select('kode_mapel', 'nama_mapel','mapel', 'first_name')
                                ->groupBy('kode_mapel', 'nama_mapel','mapel', 'first_name')
                                ->get(),
        ];
        return view('absen.tableAbsenGroup', $data);
    }

    public function tabel_report(Request $request):view
    {
        $start = $request->date_start;
        $mapel = $request->mapel;
        $kelas = $request->kelas;

        $data = [
            'title'     => 'Laporan Absensi',
            'result'    => Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                            ->where('absens.kelas', $kelas)->where('mapel', $mapel)
                            ->where('tanggal_absen', $start)
                            ->get(),
            'mapel'     => Mapel::all(),
            'kelas'     => Room::where('tingkat', Auth::user()->tingkat)->get(),
            'mapelRow'  => Mapel::where('idmapel', $mapel)->first(),
            'kelasRow'  => Room::where('idkelas', $kelas)->first(),
            'start'     => $start,
            'tabel'     => 1,
        ];
        return view('absen.report', $data);
    }

    public function testing()
    {
        $data = Absen::join('rooms', 'rooms.idkelas', '=', 'absens.kelas')
                                ->join('registers', 'registers.user_id', '=', 'absens.siswa_id')
                                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                                ->join('mapels', 'mapels.idmapel', 'absens.mapel')
                                ->join('users', 'users.id', '=', 'absens.siswa_id')
                                ->where('absens.status', 'close')
                                ->select('rooms.kode_kelas', 'mapels.nama_mapel', 'tanggal_absen', 'students.nisn',
                                'registers.nis', 'users.first_name', 'students.gender', 'absensi')
                                ->get();

        return response()->json($data);
    }

    /**Absen Guru */
    public function absenGuru(): View
    {
        $data = [
            'title'     => 'Absensi Guru & Staff',
        ];
        return view('absen.guru.index', $data);
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
