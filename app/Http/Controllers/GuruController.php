<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\BiodataTeacher;
use App\Models\Campu;
use App\Models\Gurumapel;
use App\Models\KepegawaianTeacher;
use App\Models\KompetensiKhususTeacher;
use App\Models\KompetensiTeacher;
use App\Models\Level;
use App\Models\Mapel;
use App\Models\PenugasanTeacher;
use App\Models\Room;
use App\Models\SchoolTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():view
    {
        $campus = Auth::user()->campus_id;
        if(Auth::user()->level == 0){
            $guru = User::join('levels', 'levels.idlevel', '=', 'users.level')
                            ->join('campus', 'campus.idcampus', '=', 'users.campus_id')
                            ->orWhere('level', 1)->orWhere('level', 2)
                            ->orWhere('level', 3)->orWhere('level', 5)
                            ->orderBy('id', 'DESC')->get();
        }else{
            $guru = User::where('campus_id', $campus)
                            ->where('level', '!=', 4)
                            ->join('levels', 'levels.idlevel', '=', 'users.level')
                            ->join('campus', 'campus.idcampus', '=', 'users.campus_id')
                            ->orderBy('id', 'DESC')->get();
        }
        $data = [
            'title'     => 'Data Guru',
            'guru'      => $guru,
            'campus'    => Campu::where('idcampus', '>', 1)->get(),
            'level'     => Level::all(),
        ];

        return view('guru.index', $data);
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
            'first_name'    => 'required|min:3',
            'email'         => 'required|unique:users|email',
            'phone'         => 'required|unique:users',
            'gender'        => 'required',
            'nik'           => 'required|unique:teachers|min:16',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if(Auth::user()->campus_id == 0){
            $campusId = $request->campus_id;
        }else{
            $campusId  = Auth::user()->campus_id;
        }

        //Generate Password
        $inputPassword = $request->tanggal_lahir;
        $password = substr($inputPassword, 8, 2).substr($inputPassword, 5, 2).substr($inputPassword, 0, 4);

        $user =[
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'status'        => 1,
            'phone'         => $request->phone,
            'telephone'     => $request->telephone,
            'photo'         => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'     => $campusId,
            'kelas'         => 0,
            'password'      => Hash::make($password),
            'level'         => $request->level,   
        ];
        $createUser = User::create($user);

        $teacher=[
            'user_id'       => $createUser->id,
            'jenis_kelamin' => $request->gender,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik'           => $request->nik,
            'kk'            => NULL,
            'ibu_kandung'   => $request->ibu,
        ];
        $createTeacher = Teacher::create($teacher);

        BiodataTeacher::create([
            'user_id'               => $createUser->id,
        ]);

        Alamat::create([
            'user_id'   => $createUser->id,
        ]);

        SchoolTeacher::create([
            'user_id'   => $createUser->id,
        ]);

        KepegawaianTeacher::create([
            'user_id'   => $createUser->id,
        ]);

        KompetensiKhususTeacher::create(['user_id' => $createUser->id]);
        PenugasanTeacher::create(['user_id' => $createUser->id]);


        return redirect()->intended('/guru')->with(['success' => 'Data berhasil disimpan']);
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
            'title'     => 'Detail Guru',
            'guru'      => User::where('id', $id)->join('levels', 'levels.idlevel', '=', 'users.level')->first(),
            'teacher'   => Teacher::where('user_id', $id)->first(),
            'level'     => Level::all(),
            'mapel'     => Mapel::where('mapel_campus', Auth::user()->campus_id)->get(),
            'kelas'     => Room::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('guru.show', $data);
    }


    public function loadFoto($id):View
    {
        $data = [
            'guru'      => User::where('id', $id)->join('levels', 'levels.idlevel', '=', 'users.level')->first(),
        ];
        return view('guru.foto', $data);
    }

    public function detail($id):view
    {
        $data = [
            'guru'      => User::where('id', $id)->join('levels', 'levels.idlevel', '=', 'users.level')->first(),
            'teacher'   => Teacher::where('user_id', $id)->first(),
        ];
        return view('guru.details', $data);
    }

    public function single($id)
    {
        $data = [
            'guru'      => User::join('levels', 'levels.idlevel', '=', 'users.level')
                                ->where('id', $id)->first(),
            'teacher'   => Teacher::where('user_id', $id)->first(),
        ];
        return json_encode($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'first_name'    => 'required',
            'email'         => 'required|email',
            'level'         => 'required|max:2',
            'phone'            => 'required',
        ]);

        $user = [
            'first_name'    => $request->first_name,
            'level'         => $request->level,
            'email'         => $request->email,
            'phone'         => $request->phone,
        ];

        $id = $request->id;
        User::where('id', $id)->update($user);
        //Teacher::where('user_id', $id)->update($teacher);
        return response(['success' => 'Data Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request):RedirectResponse
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $id = $request->id;
        User::where('id', $id)->delete();
        return redirect()->intended('/guru')->with(['success' => 'Data telah dihapus!']);   
    }

    public function changeImage(Request $request)
    {
        $photo = $request->file('photo');
        $ekstensi = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $url = "https://sim.iqis.sch.id/storage/photo-users/";
        $filename = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path = 'photo-users/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $id = $request->id;
        $data = [
            'photo'     => $url.$filename,
        ];

        User::where('id', $id)->update($data);
    }

    public function tableMapel($id): View
    {
        $data = [
            'result'    => Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                                    ->join('users', 'users.id', '=', 'gurumapels.user_id')
                                    ->where('user_id', $id)->where('gurumapels.campus_id', Auth::user()->campus_id)
                                    ->select('gurumapels.kelas as kelas_mapel', 'nama_mapel', 'kode_mapel', 'idmg')
                                    ->get(), 
        ];
        return view('guru.tableMapel', $data);
    }
    public function addMapel(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        Gurumapel::create([
            'mapel_id'      => $request->mapel,
            'user_id'       => $request->id,
            'kelas'         => $request->kelas,
            'campus_id'     => Auth::user()->campus_id,
        ]);
        return response(['success' => 'trues']);
    }
    public function deleteMapel(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);
        Gurumapel::where('idmg', $request->id)->delete();
        return response(['success' => 'Item Deleted.!']);
    }
}
