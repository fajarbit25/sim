<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\TracertStudy;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():view
    {
        $data = [
            'title'     => 'Kelas',
            'guru'      => User::where('campus_id', Auth::user()->campus_id)->where('level', 2)->get(),
        ];
        return View('kelas.index', $data);
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
    public function store(Request $request)
    {
        $request->validate([
            'kelas'     => 'required',
            'wali'      => 'required',
        ]);
        $data = [
            'tingkat'       => $request->tingkat,
            'kode_kelas'    => $request->kelas,
            'wali_kelas'    => $request->wali,
            'campus_id'  => Auth::user()->campus_id,
        ];
        Room::create($data);
        return response(['success' => 'Berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Room::where('idkelas', $id)->join('users', 'users.id', '=', 'rooms.wali_kelas')->first();
        return json_encode($kelas);
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
        $request->validate([
            'kelasEdit' => 'required',
            'waliEdit'  => 'required',
            'tingkat'   => 'required',
        ]);
        $id = $request->idkelas;
        $data = [
            'kode_kelas'    => $request->kelasEdit,
            'wali_kelas'    => $request->waliEdit,
            'tingkat'       => $request->tingkat,
        ];
        
        //update
        Room::where('idkelas', $id)->update($data);
        return response(['success' => 'Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Load tabel kelas ajax
    public function laod_tabel()//:view
    {
        $data = [
            'kelas'             => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                    ->where('users.campus_id', Auth::user()->campus_id)->paginate(10),
            'dataModalKelas'    => Room::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return View('kelas.table', $data);
    }

    //pencarian ajax
    public function search($key)
    {
        $data = [
            'kelas'     => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                ->where('kode_kelas', 'like', "%".$key."%")
                                ->orwhere('users.first_name', 'like', "%".$key."%")
                                ->paginate(1000),
        ];
        return View('kelas.table', $data);
    }

    //add siswa to kelas
    public function kelas_siswa($id):view
    {
        $data = [
            'title'     => 'Add Siswa To Kelas',
            'kelas'     => Room::where('idkelas', $id)->first(),
        ];
        return view('kelas.add_siswa', $data);
    }

    //Load jumlah siswa perkelas
    public function studentCount()
    {
        $kelas = Room::where('campus_id', Auth::user()->campus_id)->get();
        
        foreach($kelas as $kelasItem){
            $loadCountSiswa = User::where('kelas', $kelasItem->idkelas)->count();

            $countSiswa[] = [
                'id'            => $kelasItem->idkelas,
                'jumlah_siswa'  => $loadCountSiswa,
            ];
        }

        return response()->json($countSiswa);
    }

    public function siswaUnAlocated()
    {
        $data = [
            'user'  => User::join('students', 'students.user_id', '=', 'users.id', 'left')->where('level', 4)->where('kelas', 0)->get(),
        ];
        return view('kelas.add_unalocated', $data);
    }

    public function siswaAlocated($kelas)
    {
        $data = [
            'user'  => User::join('students', 'students.user_id', '=', 'users.id', 'left')->where('level', 4)->where('kelas', $kelas)->get(),
        ];
        return view('kelas.add_alocated', $data);
    }

    public function addSiswa(Request $request)
    {
        $request->validate([
            'idkelas'   => 'required',
            'id'        => 'required',
        ]);
        
        User::where('id', $request->id)->update(['kelas' => $request->idkelas]);
    }

    public function returnSiswa(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);
        
        User::where('id', $request->id)->update(['kelas' => 0]);
    }

    /**Modul Naik Kelas */
    public function previewNaikKelas($id)
    {
        $kelas = Room::where('idkelas', $id)
                    ->join('users', 'rooms.wali_kelas', '=', 'users.id')
                    ->select('idkelas as id', 'kode_kelas as kelas', 'first_name as wali')
                    ->first();
        $data = [
            'kelasAwal'     => $kelas,
            'jumlahSiswa'   => User::where('kelas', $kelas->id)->count(),
        ];
        return response()->json($data);
    }

    public function naikKelasTujuan($id)
    {
        $data = [
            'count' => User::where('kelas', $id)->count(),
        ];
        return response()->json($data);
    }

    public function naikKelasProcess(Request $request)
    {
        $request->validate([
            'asal'      => 'required',
            'tujuan'    => 'required',
        ]);

        //Definisi variabel
        $asal = $request->asal;
        $tujuan = $request->tujuan;

        //Cek Kelas jumlah siswa di kelas tujuan
        $count = User::where('kelas', $tujuan)->count();
        if($count != 0){
            return response()->json([
                'status'    => 500,
                'message'   => 'Data kelas tujuan belum dikosongkan!',
            ]);
        }

        //Cek Kelas jumlah siswa di kelas asal
        $countAsal = User::where('kelas', $asal)->count();
        if($countAsal == 0){
            return response()->json([
                'status'    => 500,
                'message'   => 'Kelas asal tidak memiliki siswa!',
            ]);
        }

        

        $siswa = User::where('kelas', $asal)->get();

        //Jika kelas tujuan adalah tamat, maka isi data tracer study
        if($tujuan == 'Tamat'){

            //Megisi database tracert study
            foreach($siswa as $item){
                $dataSiswa = [
                    'user_id'           => $item->id,
                    'kelas_terakhir'    => $asal,
                    'campus_id'         => Auth::user()->campus_id,
                    'angkatan'          => date('Y'),
                ];
                TracertStudy::create($dataSiswa);
            }
            //Proses Pemindahan siswa ke kelas baru
            User::where('kelas', $asal)->update(['kelas' => $tujuan,]);
            
            return response()->json([
                'status'    => 200,
                'message'   => 'Proses berhasil!',
            ]);

        }else{

            //Proses Pemindahan siswa ke kelas baru
            User::where('kelas', $asal)->update(['kelas' => $tujuan,]);
            return response()->json([
                'status'    => 200,
                'message'   => 'Proses Naik Kelas berhasil!',
            ]);

        }
        

        

    }
    /**End Modul Naik Kelas */

}
