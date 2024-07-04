<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\News;
use App\Models\Absen_chart;
use App\Models\Activity;
use App\Models\Alamat;
use App\Models\BiodataTeacher;
use App\Models\Campu;
use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\KepegawaianTeacher;
use App\Models\KompetensiKhususTeacher;
use App\Models\PendidikanTeacher;
use App\Models\PenugasanTeacher;
use App\Models\Ppdb;
use App\Models\Ppdbmaster;
use App\Models\Room;
use App\Models\SchoolTeacher;
use App\Models\Score;
use App\Models\Semester;
use App\Models\SertifikasiTeacher;
use App\Models\Siswalog;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public function index()//:view
    {
            if(Auth::user()->level == 0){
                $data = [
                    'title'         => 'Dashboard',
                    'news'          => News::join('users', 'users.id', '=', 'news.user_id')->get(),
                    //'cat'           => Absen_chart::orderBy('tanggal_absen', 'ASC')->limit(6)->get(),
                    'ppdb'          => Ppdb::where('user_id', Auth::user()->id)->first(),
                    'ppdb_master'   => Ppdbmaster::where('idpm', 1)
                                            ->join('semesters', 'semesters.tahun_ajaran', '=', 'ppdbmasters.tahun_id')
                                            ->first(),
                    'user'          => User::find(Auth::user()->id),
                    'count_campus'  => Campu::count(),
                    'count_siswa'   => User::where('status', 1)->where('level', 4)->count(),
                    'count_guru'    => User::where('status', 1)->where('level', '<', 4)->count(),
                    'kelas'         => Room::where('campus_id', Auth::user()->campus_id)->get(),
                    'guru'          => User::where('status', 1)->where('level', 2)
                                            ->where('campus_id', Auth::user()->campus_id)->get(),
                ];
                return View('dashboard.dashboard', $data); 
            }

            if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3 || Auth::user()->level == 5){
                $data = [
                    'title'         => 'Dashboard',
                    'news'          => News::join('users', 'users.id', '=', 'news.user_id')->get(),
                    'ppdb'          => Ppdb::where('user_id', Auth::user()->id)->first(),
                    'ppdb_master'   => Ppdbmaster::where('idpm', 1)
                                            ->join('semesters', 'semesters.tahun_ajaran', '=', 'ppdbmasters.tahun_id')
                                            ->first(),
                    'user'          => User::find(Auth::user()->id),
                    'count_campus'  => Campu::count(),
                    'count_siswa'   => User::where('status', 1)->where('level', 4)->where('campus_id', Auth::user()->campus_id)->count(),
                    'count_guru'    => User::where('status', 1)->where('level', '<', 4)->where('campus_id', Auth::user()->campus_id)->count(),
                    'kelas'         => Room::where('campus_id', Auth::user()->campus_id)->where('campus_id', Auth::user()->campus_id)->get(),
                    'guru'          => User::where('status', 1)->where('level', 2)
                                            ->where('campus_id', Auth::user()->campus_id)->get(),
                ];
                return View('dashboard.dashboard', $data); 
            }

            if(Auth::user()->level == 4){
                $id = Auth::user()->id;
                $semester = Semester::where('is_active', 'true')->first();
                $semesterKode = $semester->semester_kode;
                $ta = $semester->tahun_ajaran;
                
                $datasiswa = [
                    'title'     => 'Dashboard',
                    'campus'    => Campu::where('idcampus', Auth::user()->campus_id)->first(),
                    'students'  => Student::where('user_id', $id)->first(),
                    'nilai'     => Score::where('siswa_id', $id)->where('semester', $semesterKode)->where('ta', $ta)
                                    ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')->get(),
                    'logs'      => Siswalog::where('user_id',$id)->where('tanggal', date('Y-m-d'))->orderBy('id', 'DESC')->get(),
                    'countInv'  => Invoice::where('user_id', Auth::user()->id)->where('invoice_status', 'Unpaid')->count(),
                    'user'      => User::find(Auth::user()->id),
                    'ppdb'      => Ppdb::where('user_id', Auth::user()->id)->first(),
                ];
                return view('dashboard.orang_tua', $datasiswa); 
            }
    }



    public function tahfidz()
    {
        $data = DB::table('absen_charts')->select('hari_absen');
        return json_encode($data);
    }

    /**Manage Profile */
    public function profile():view
    {
        $data = [
            'title'     => 'Manage Profile',
            'user'      => User::join('teachers', 'teachers.user_id', '=', 'users.id')->where('id', Auth::user()->id)->first(),
            'biodata'   => BiodataTeacher::where('user_id', Auth::user()->id)->first(),
            'address'   => Alamat::where('user_id', Auth::user()->id)->first(),
            'sekolah'   => SchoolTeacher::where('user_id', Auth::user()->id)->first(),
            'kepegawaian'=> KepegawaianTeacher::where('user_id', Auth::user()->id)->first(),
            'kompetensi'=> KompetensiKhususTeacher::where('user_id', Auth::user()->id)->first(),
            'penugasan' => PenugasanTeacher::where('user_id', Auth::user()->id)->first(),
        ];
        return view('user.profile', $data);
    }


    public function profile_akun():view
    {
        $data = [
            'title'     => 'Manage Profile Akun',
            'user'      => User::join('teachers', 'teachers.user_id', '=', 'users.id')->where('id', Auth::user()->id)->first(),
        ];
        return view('user.profile_akun', $data);
    }
    public function profile_image()
    {
        $data = [
            'user'      => User::where('id', Auth::user()->id)->first(),
        ];
        return view('user.profile_image', $data);
    }
    public function change_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => [
                        'required',
                        File::types(['img', 'jpeg', 'jpg', 'png'])->max(20000),
                    ]
        ]);

        if ($validator->fails()) {
            return response(['warning' => 'upload gagal!']);
        }

        /** Save foto */
        $photo          = $request->file('photo');
        $ekstensi       = $photo->getClientOriginalExtension();
        $randomName     = rand(1111, 9999);
        $filename       = date('Ymdhis').'-'.$randomName.'.'.$ekstensi; //nama file
        $path           = 'photo-users/'.$filename; //path di folder public
        $urlPhoto       = URL::to('/'); //url domain
        $storeName      = $urlPhoto.'/storage/'.$path; //Nama yang di store ke db

        Storage::disk('public')->put($path, file_get_contents($photo));

        $id = Auth::user()->id;
        $data = [
            'photo'     => $storeName,
        ];

        User::where('id', $id)->update($data);
        return response(['success' => 'upload berhasil!']);
    }
    public function updateProfile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'first_name'    => 'required',
            'email'         => 'required|email',
            'phone'         => 'required|min:10|max:13',
        ]);
        if($validated->fails()){
            return response(['warning' => 'update gagal!']);
        }

        $data = [
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
        ];
        $id = Auth::user()->id;
        User::where('id', $id)->update($data);
        return response(['success' => 'update berhasil!']);
        
    }
    public function change_password(Request $request):RedirectResponse
    {
        $request->validate([
            'current_pass'      => 'required',
            'new_pass'          => 'required',
            'repeat_pass'       => 'required|same:new_pass',
        ]);

        $passwordCheck = Hash::check($request->current_pass, Auth::user()->password);
        if($passwordCheck){
            User::findOrFail(Auth::user()->id)->update([
                'password'  => Hash::make($request->new_pass)
            ]);
            return redirect()->back()->with(['success' => 'Password Updated Successfully!']);
        }else{
            return redirect()->back()->with(['success' => 'Current Password Does Not Match!']);
        }
    }

    //Profile siswa
    public function profile_siswa():view
    {
        $data = [
            'title'     => 'Manage Profile',
            'user'      => User::join('students', 'students.user_id', '=', 'users.id')->where('id', Auth::user()->id)->first(),
        ];
        return view('siswa.profile', $data);
    }
    public function profile_siswa_akun():view
    {
        $data = [
            'title'     => 'Manage Profile Akun',
            'user'      => User::join('students', 'students.user_id', '=', 'users.id')->where('id', Auth::user()->id)->first(),
        ];
        return view('siswa.profile_akun', $data);
    }
    /**End Manage Profile */

    /**Activity */
    public function activity(): View
    {
        $data = [
            'result'   => Activity::join('users', 'users.id', '=', 'activities.user_id')
                                    ->join('rooms', 'rooms.idkelas', '=', 'activities.room_id')
                                    ->where('tanggal', date('Y-m-d'))
                                    ->where('activities.campus_id', Auth::user()->campus_id)
                                    ->select('jam', 'rooms.kode_kelas', 'kegiatan', 'users.first_name')
                                    ->orderBy('jam', 'DESC')->paginate(1),
        ];
        return view('dashboard.tableActivity', $data);
    }
    
    public function activitySearchKelas($kelas):View
    {
        $data = [
            'result'   => Activity::join('users', 'users.id', '=', 'activities.user_id')
                                    ->join('rooms', 'rooms.idkelas', '=', 'activities.room_id')
                                    ->where('tanggal', date('Y-m-d'))
                                    ->where('activities.campus_id', Auth::user()->campus_id)
                                    ->where('activities.room_id', $kelas)
                                    ->select('jam', 'rooms.kode_kelas', 'kegiatan', 'users.first_name')
                                    ->orderBy('jam', 'DESC')->paginate(100),
        ];
        return view('dashboard.tableActivity', $data);
    }

    public function activitySearchGuru($guru):View
    {
        $data = [
            'result'   => Activity::join('users', 'users.id', '=', 'activities.user_id')
                                    ->join('rooms', 'rooms.idkelas', '=', 'activities.room_id')
                                    ->where('tanggal', date('Y-m-d'))
                                    ->where('activities.campus_id', Auth::user()->campus_id)
                                    ->where('activities.user_id', $guru)
                                    ->select('jam', 'rooms.kode_kelas', 'kegiatan', 'users.first_name')
                                    ->orderBy('jam', 'DESC')->paginate(100),
        ];
        return view('dashboard.tableActivity', $data);
    }
    /**End Activity */

    /**update Alamat */
    public function updateTeacherAddressProvice(Request $request)
    {
        Alamat::where('user_id', Auth::user()->id)->update([
            'provinsi'  => $request->name,
            'idprovinsi'=> $request->id,
        ]);
    }

    public function updateTeacherAddressCity(Request $request)
    {
        Alamat::where('user_id', Auth::user()->id)->update([
            'kota'  => $request->name,
            'idkota'=> $request->id,
        ]);
    }

    public function updateTeacherAddressDistricts(Request $request)
    {
        Alamat::where('user_id', Auth::user()->id)->update([
            'kec'  => $request->name,
            'idkec'=> $request->id,
        ]);
    }

    public function updateTeacherAddressVillages(Request $request)
    {
        Alamat::where('user_id', Auth::user()->id)->update([
            'kel'  => $request->name,
            'idkel'=> $request->id,
        ]);
    }

}
