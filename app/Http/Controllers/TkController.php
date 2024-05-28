<?php

namespace App\Http\Controllers;

use App\Models\Campu;
use App\Models\Priodik;
use App\Models\RaportMidTk;
use App\Models\RaportMidTkNilai;
use App\Models\RaportTkHafalan;
use App\Models\RaportTkNarasi;
use App\Models\RaportTkNarasiGambar;
use App\Models\Room;
use App\Models\RppmDiniyah;
use App\Models\RppmdiniyahNilai;
use App\Models\Semester;
use App\Models\TkDailyReport;
use App\Models\TkSubdailyReport;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TkController extends Controller
{
    /**Daily Report */
    public function dailyReport(): View
    {
        $data = [
            'title'         => 'Daily Report',
            'countFoto'     => TkDailyReport::where('tanggal', date('Y-m-d'))
                                            ->where('foto', '!=', '0')->count(),
            'dailyReport'   => TkDailyReport::where('tanggal', date('Y-m-d'))
                                            ->where('foto', '!=', '0')->first(),
            'riwayat'       => TkDailyReport::where('tanggal', '!=', date('Y-m-d'))
                                            ->where('foto', '!=', '0')
                                            ->orderBy('id', 'DESC')->limit(20)->get(),
        ];
        return view('tk.daily-report', $data);
    }

    public function loadDataJson()
    {
        $data = [
            'dailyReport'   => TkDailyReport::where('tanggal', date('Y-m-d'))
                                            ->where('foto', '!=', '0')->first(),
            'countFoto'     => TkDailyReport::where('tanggal', date('Y-m-d'))
                                            ->where('foto', '!=', '0')->count(),
        ];
        return response()->json($data);
    }

    public function tableDailyReport(): View
    {
        $data = [
            'result'    => TkDailyReport::where('tanggal', date('Y-m-d'))
                                        ->where('foto', '0')
                                        ->select('keterangan', 'tk_daily_reports.id as id', 'tab_submenu')
                                        ->get(),
            'sub'       => TkSubdailyReport::leftJoin('tk_daily_reports', 'tk_daily_reports.id', '=', 'tk_subdaily_reports.id_daily_report')
                                        ->where('tanggal', date('Y-m-d'))
                                        ->where('foto', '0')
                                        ->select('tk_subdaily_reports.id as subid', 'subketerangan', 'id_daily_report')
                                        ->get(),

        ];
        return view('tk.daily-report.table-daily', $data);
    }

    public function drAddKeterangan(Request $request)
    {
        $request->validate(['keterangan'    => 'required']);

        $data = [
            'foto'          => '0',
            'tanggal'       => date('Y-m-d'),
            'keterangan'    => $request->keterangan,
            'tab_submenu'   => 0,
            'updated_by'    => Auth::user()->id,
        ];
        TkDailyReport::create($data);

        return response()->json([
            'status'    => 200,
            'message'   => 'Keterangan ditambahkan!',
        ], 200);
    }

    public function drUploadFoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'          => 'required|file|mimes:png,jpg,jpeg,svg|max:500',
            'jenis'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 422,
                'success'   => false, 
                'errors'    => $validator->errors()
            ], 422);
        }

        $file = $request->file('file');
        $ekstensi   = $file->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'tk-daily'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'tk-daily/'.$filename;

        // Simpan file ke penyimpanan Laravel
        Storage::disk('public')->put($path,file_get_contents($file));

        if($request->jenis == 'Update'){

        }else{
            $data = [
                'foto'          => $filename,
                'tanggal'       => date('Y-m-d'),
                'keterangan'    => '-',
                'tab_submenu'   => 0,
                'updated_by'    => Auth::user()->id,
            ];
            TkDailyReport::create($data);
            return response()->json([
                'status'    => 200,
                'message'   => 'Keterangan ditambahkan!',
            ], 200);
        }
    }

    public function loadSubTema()
    {
        $data = TkSubdailyReport::leftJoin('tk_daily_reports', 'tk_daily_reports.id', '=', 'tk_subdaily_reports.id_daily_report')
                                    ->where('tanggal', date('Y-m-d'))
                                    ->where('foto', '0')->get();
        return response()->json($data);
    }

    public function drSubTema(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'subKeterangan' => 'required',
        ]);

        $data = [
            'id_daily_report'   => $request->id,
            'subketerangan'     => $request->subKeterangan,
            'updated_by'        => Auth::user()->id,
        ];
        TkSubdailyReport::create($data);

        return response()->json([
            'status'    => 200,
            'message'   => 'Sub Keterangan ditambahkan!',
        ], 200);

    }

    public function addSubTema(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $dailyReport = TkDailyReport::findOrFail($request->id);
        $dailyReport->update(['tab_submenu' => 1]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Add Sub Keterangan!',
        ], 200);
    }

    public function deleteTema(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $dailyReport = TkDailyReport::findOrFail($request->id);
        $dailyReport->delete();

        $subTema = TkSubdailyReport::where('id_daily_report', $request->id)->delete();

        return response()->json([
            'status'    => 200,
            'message'   => 'Tema dihapus!',
        ], 200);

    }

    public function deleteSub(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $dailyReport = TkSubdailyReport::findOrFail($request->id);
        $dailyReport->delete();

        return response()->json([
            'status'    => 200,
            'message'   => 'Tema dihapus!',
        ], 200);
    }

    /**RPPM Diniyah */
    public function rppmDiniyah(): View
    {
        $data = [
            'title'     => 'RPPM Diniyah',
        ];
        return view('tk.rppm-diniyah.index', $data);
    }
    public function rppmDiniyahPrint($id):view
    {
        $rppmDiniyah = RppmDiniyah::findOrFail($id);

        $result = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $rppmDiniyah->semester)
                        ->where('bulan', $rppmDiniyah->bulan)->where('pekan', $rppmDiniyah->pekan)
                        ->where('kelompok_id', $rppmDiniyah->kelompok_id)->get();

        //Ambil data segment
        foreach($result as $getSegment){
                $getSegment->segmentMateri =  RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $rppmDiniyah->semester)
                                        ->where('bulan', $rppmDiniyah->bulan)->where('pekan', $rppmDiniyah->pekan)
                                        ->where('kelompok_id', $rppmDiniyah->kelompok_id)
                                        ->where('segment_materi', $getSegment->segment_materi)
                                        ->get();
        }

        //Ambil data kegiatan untuk setiap materi
        foreach($result as $getMateri){
            $getMateri->getKegiatan = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $rppmDiniyah->semester)
                                        ->where('bulan', $rppmDiniyah->bulan)->where('pekan', $rppmDiniyah->pekan)
                                        ->where('kelompok_id', $rppmDiniyah->kelompok_id)
                                        ->where('materi', $getMateri->materi)->get();
        }

        //Ambil data nilai untuk setiap materi
        foreach ($result as $materi) {
            $materi->nilai = RppmdiniyahNilai::where('rppm_diniyah_id', $materi->id)->get();
        }

        //Ambil data Wali kelas
        $getKelas = Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                            ->where('rooms.campus_id', Auth::user()->campus_id)
                            ->where('kode_kelas', $rppmDiniyah->kelompok_id)
                            ->first();

        $data = [
            'title'     => 'Rppm Diniyah',
            'siswa'     => RppmdiniyahNilai::join('users', 'users.id', '=', 'rppmdiniyah_nilais.user_id')
                                    ->where('rppm_diniyah_id', $id)
                                    ->select('users.first_name as name')->get(),
            'result'    => $result,
            'data'      => $rppmDiniyah,
            'wali_kelas'=> $getKelas->first_name,

        ];
        return view('tk.rppm-diniyah.print', $data);
    }

    public function raportSemester(): View
    {
        $data = [
            'title'     => 'Raport Semester',

        ];
        return view('tk.raport-semester.index', $data);
    }

    public function raportSemesterPrint($id):view
    {
        $dataNarasi = RaportTkNarasi::findOrFail($id);
        $user_id = $dataNarasi->user_id;
        $user = User::findOrFail($user_id);

        $data = [
            'title'         => 'Raport Semester',
            'narasi'        => $dataNarasi,
            'fotoAgama'     => RaportTkNarasiGambar::where('id_narasi', $dataNarasi->id)->where('segment', 'Agama')->get(),
            'fotoJDiri'     => RaportTkNarasiGambar::where('id_narasi', $dataNarasi->id)->where('segment', 'Jati-Diri')->get(),
            'fotoLiterasi'  => RaportTkNarasiGambar::where('id_narasi', $dataNarasi->id)->where('segment', 'Literasi')->get(),
            'user'          => $user,
            'kelas'         => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                ->where('idkelas', $user->kelas)
                                ->select('users.first_name as walikelas', 'kode_kelas')->first(),
            'kepsek'        => Campu::where('idcampus', Auth::user()->campus_id)->select('campus_kepsek')->first(),
            'priodik'       => Priodik::where('user_id', $user_id)->select('tinggi', 'berat')->orderBy('created_at', 'DESC')->first(),
        ];
        return view('tk.raport-semester.print', $data);
    }

    public function raportSemesterPrintHafalan($id):View
    {
        $dataNarasi = RaportTkNarasi::findOrFail($id);
        $dataUser = User::join('students', 'students.user_id', '=', 'users.id')
                        ->join('registers', 'registers.user_id', '=', 'users.id')
                        ->where('users.id', $dataNarasi->user_id)
                        ->select('users.id as id', 'first_name', 'nisn', 'registers.nis')
                        ->first();
        $data = [
            'title'             => 'Raport Semester Hafalan',
            'narasi'            => $dataNarasi,
            'ayat'              => RaportTkHafalan::where('id_narasi', $dataNarasi->id)
                                    ->where('materi', 'Tahfidz')->select('kegiatan', 'nilai')->get(),
            'hadist'            => RaportTkHafalan::where('id_narasi', $dataNarasi->id)
                                    ->where('materi', 'Hadist')->select('kegiatan', 'nilai')->get(),
            'doa'               => RaportTkHafalan::where('id_narasi', $dataNarasi->id)
                                    ->where('materi', 'Doa')->select('kegiatan', 'nilai')->get(),
            'user'              => $dataUser,
            'kelas'             => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                    ->where('idkelas', $dataNarasi->kelas)
                                    ->select('kode_kelas', 'first_name as wali_kelas')->first(),
            'semester'          => Semester::where('is_active', 'true')->first(),
        ];
        return view('tk.raport-semester.print-hafalan', $data);
    }

    public function raportMid():View
    {
        $data = [
            'title'     => 'Raport Mid Semester',
        ];
        return view('tk.raport-mid.index', $data);

    }

    public function raportMidPenilaian():view
    {
        $data = [
            'title'     => 'Penilaian',
        ];
        return view('tk.raport-mid.penilaian', $data);
    }

    public function raportMidForm():View
    {
        $data = [
            'title'     => 'Form Rapor',
        ];
        return view('tk.raport-mid.form ', $data);
    }

    public function raportMidPrint($id):View
    {
        $dataRaport = RaportMidTk::findOrFail($id);
        $data = [
            'title'         => 'Cetak Raport Siswa',
            'dataAgama'     => RaportMidTkNilai::where('id_raport', $id)->where('kategori', 'Agama')->get(),
            'dataAll'       => RaportMidTkNilai::where('id_raport', $id)->where('kategori', '!=', 'Agama')->get(),
            'raport'        => $dataRaport,
            'campus'        => Campu::where('idcampus', Auth::user()->campus_id)->first(),
            'kelas'         => Room::join('users', 'users.id', '=', 'rooms.wali_kelas')
                                    ->where('idkelas', $dataRaport->kelas)
                                    ->select('kode_kelas', 'first_name as wali')->first(),
            'priodik'       => Priodik::join('users', 'users.id', '=', 'priodiks.user_id')
                                    ->join('registers', 'registers.user_id', '=', 'priodiks.user_id')
                                    ->where('priodiks.user_id', $dataRaport->user_id)
                                    ->orderBy('priodiks.created_at', 'DESC')
                                    ->select('tinggi', 'berat', 'nis', 'first_name as nama_siswa')
                                    ->first(),
        ];
        return view('tk.raport-mid.print ', $data);
    }

}
