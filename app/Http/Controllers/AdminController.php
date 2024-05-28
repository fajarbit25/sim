<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Document;
use App\Models\Formulirinformation;
use App\Models\Kesejahteran;
use App\Models\Ppdb;
use App\Models\Ppdbmaster;
use App\Models\Prestasi;
use App\Models\Priodik;
use App\Models\Register;
use App\Models\Scholarship;
use App\Models\Semester;
use App\Models\Special_need;
use App\Models\Student;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /** Data PPDB terbaru */
    public function ppdb_new():View
    {
        $data = [
            'title'     => 'Data Pendaftar PPDD',
            'ppdb'      => Ppdb::where('ppdbs.status', '1')
                                    ->join('users', 'users.id', '=', 'ppdbs.user_id')
                                    ->join('students', 'students.user_id', '=', 'users.id')
                                    ->join('invoices', 'invoices.user_id', '=', 'users.id')
                                    ->join('registers', 'registers.user_id', '=', 'users.id')->get()
        ];
        return view('ppdb.admin_new', $data);
    }
    
    /**Data PPDB telah diverifikasi */
    public function ppdb():View
    {
        $data = [
            'title'     => 'Data Pendaftar PPDD',
            'ppdb'      => Ppdb::where('ppdbs.status', 400)
                                    ->join('users', 'users.id', '=', 'ppdbs.user_id')
                                    ->join('students', 'students.user_id', '=', 'users.id')
                                    ->join('registers', 'registers.user_id', '=', 'users.id')->get()
        ];
        return view('ppdb.admin_view', $data);
    }

    /**Verifikasi peserta PPDB */
    public function ppdb_verification($id):View
    {
        $data = [
            'title'     => 'Review data PPDB',
            'user'      => User::find($id),
            'ppdb'      => Ppdb::where('user_id', $id)->first(),
            'student'   => Student::where('user_id', $id)->first(),
            'register'  => Register::where('user_id', $id)->first(),
            'doc'       => Document::where('user_id', $id)->first(),
            'alamat'    => Alamat::where('user_id', $id)->first(),
            'ayah'      => Wali::where('user_id', $id)->where('segment', 'ayah')->first(),
            'ibu'       => Wali::where('user_id', $id)->where('segment', 'ibu')->first(),
            'wali'      => Wali::where('user_id', $id)->where('segment', 'wali')->first(),
            'priodik'   => Priodik::where('user_id', $id)->first(),
            'prestasi'  => Prestasi::where('user_id', $id)->get(),
            'beasiswa'  => Scholarship::where('user_id', $id)->get(),
            'kesejaheraan' => Kesejahteran::where('user_id', $id)->get(),
            'register'  => Register::where('user_id', $id)->first(),
            'specialneeds'  => Special_need::where('user_id', $id)->get(),
        ];
        return view('ppdb.admin_verification', $data);
    }

    /** PPDB Approval */
    public function ppdb_approval(Request $request):RedirectResponse
    {
        $request->validate(['approved' => 'required', 'user_id' => 'required']);
        Ppdb::where('user_id', $request->user_id)->update(['status' => $request->approved]);
        if($request->approved == '400'){
            return redirect('/admin/ppdb/new')->with(['success' => 'Approved!']);
        }
        if($request->approved == '500'){
            return redirect('/admin/ppdb/new')->with(['success' => 'Rejected!']);
        }
        if($request->approved == '1'){
            return redirect('/admin/ppdb/new')->with(['success' => 'Cancelled!']);
        }
    }

    /** PPDB Reject */
    public function ppdb_reject():view
    {
        $data = [
            'title'     => 'Data Pendaftar PPDB Belum Diterima',
            'ppdb'      => Ppdb::where('ppdbs.status', 600)
                                    ->join('users', 'users.id', '=', 'ppdbs.user_id')
                                    ->join('students', 'students.user_id', '=', 'users.id')
                                    ->join('registers', 'registers.user_id', '=', 'users.id')->get()
        ];
        return view('ppdb.admin_reject', $data);
    }

    /** Informasi Formulir PPDB */
    public function admin_informasi():View
    {
        $data = [
            'title'     => 'Informasi Formulir PPDB',
            'info'      => Formulirinformation::where('campus_id', Auth::user()->campus_id)->first(),
        ];
        return view('ppdb.admin_informasi', $data);
    }
    public function admin_informasi_update(Request $request)
    {
        $validated = $request->validate(['pesan' => 'required']);
        Formulirinformation::where('campus_id', Auth::user()->campus_id)->update($validated);
        return response(['success' => 'Informasi Updated!']);
    }
    public function master(): View
    {
        $data = [
            'title'     => 'Master PPDB',
            'master'    => Ppdbmaster::where('idpm', 1)->first(),
            'semester'  => Semester::where('is_active', 'true')->first(), 
        ];
        return view('ppdb.admin_master', $data); 
    }
    public function master_ppdb_update(Request $request)
    {
        $request->validate([
            'idpm'              => 'required',
            'tahun_penerimaan'  => 'required|min:4|max:4',
            'gelombang'         => 'required|max:1|min:1',
        ]);

        $id = $request->idpm;
        $data = [
            'tahun_id'          => $request->tahun_ajaran,
            'tahun_penerimaan'  => $request->tahun_penerimaan,
            'gelombang'         => $request->gelombang,
            'status'            => $request->status,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
        ];
        Ppdbmaster::where('idpm', $id)->update($data);
        return response(['success' => 'Data berhasil diupdate!']);
    }

    /**Tahun Akademik */
    public function tahun_akademik()
    {
        $data = [
            'title'     => 'Tahun Akademik',
        ];
        return view('dashboard.tahun_akademik', $data);
    }
    public function tahun_akademik_table(): View
    {
        $data = [
            'semester'  => Semester::limit(10)->orderBy('idsm', 'DESC')->get(),
        ];
        return view('dashboard.tahun_akademik_table', $data);
    }
    public function tahun_akademik_store(Request $request)
    {
        $request->validate([
            'tahun'     => 'required|min:9|max:9',
            'semester'  => 'required|min:1|max:1',
        ]);
        Semester::create([
            'semester_kode'     => $request->semester,
            'tahun_ajaran'      => $request->tahun,
            'is_active'         => 'false',
        ]);
        return response(['success' => 'Tahun akademik diupdate']);
    }

    public function tahun_akademik_update(Request $request)
    {
        $request->validate([
            'idsm'      => 'required',
            'tahun'     => 'required|min:9|max:9',
            'semester'  => 'required|min:1|max:1',
        ]);
        Semester::where('idsm', $request->idsm)
                    ->update([
                        'tahun_ajaran'      => $request->tahun,
                        'semester_kode'     => $request->semester,
                    ]);
        return response()->json([
            'status'    => 200,
            'message'   => 'Update berhasil',
        ]);
    }

    public function tahun_akademik_setActive(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);
        $id = $request->id;

        //Nonaktifkan semua
        Semester::query()->update([
            'is_active'     => 'false',
        ]);

        //Aktifkan id terpilih
        Semester::where('idsm', $id)->update([
            'is_active'     => 'true',
        ]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Activated!',
        ]);
    }

    public function deleteSemester(Request $request)
    {
        $request->validate([
            'id'    => 'required'
        ]);
        $id = $request->id;

        Semester::where('idsm', $id)->delete();

        return response()->json([
            'status'    => 200,
            'message'   => 'Deleted!',
        ]);
    }
}
