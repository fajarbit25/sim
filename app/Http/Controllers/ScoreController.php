<?php

namespace App\Http\Controllers;

use App\Models\BulanKaldik;
use App\Models\Campu;
use App\Models\Score;
use App\Models\Mapel;
use App\Models\Prosem;
use App\Models\Prota;
use App\Models\Room;
use App\Models\Semester;
use App\Models\Silabus;
use App\Models\Student;
use App\Models\TagKaldik;
use App\Models\TanggalKaldik;
use App\Models\TkKaldik;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
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
    public function index():view
    {
        $semester = Semester::where('is_active', 'true')->first();
        if($semester->semester_kode == 1){
            $semester_name = 'Ganjil';
        }else{
            $semester_name = 'Genap';
        }

        $data = [
            'title'     => 'Form Nilai Siswa',
            'mapel'     => Mapel::join('gurumapels', 'gurumapels.mapel_id', '=', 'mapels.idmapel')
                                ->where('gurumapels.user_id', Auth::user()->id)
                                ->get(),
            'kelas'     => Room::where('campus_id', Auth::user()->campus_id)->get(),
            'semester'  => $semester_name,
            'tahun_ajaran'=> $semester->tahun_ajaran,
        ];
        return view('nilai.index', $data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($kelas, $mapel):view
    {
        $semester = Semester::where('is_active', 'true')->first();
        $data = [
            'nilai'     => Score::join('users', 'users.id', '=', 'scores.siswa_id')
                            ->join('students', 'students.user_id', '=', 'scores.siswa_id')
                            ->where('scores.kelas', $kelas)->where('mapel', $mapel)
                            ->where('semester', $semester->semester_kode)
                            ->where('ta', $semester->tahun_ajaran)
                            ->where('scores.user_id', Auth::user()->id)->get(),
        ];
        return view('nilai.form', $data);
    }

    public function cekBtnSubmit($kelas, $mapel)
    {
        $semester   = Semester::where('is_active', 'true')->first();
        $jumlah     = Score::where('scores.kelas', $kelas)->where('mapel', $mapel)
                            ->where('semester', $semester->semester_kode)
                            ->where('ta', $semester->tahun_ajaran)->count();
        $value      = Score::where('scores.kelas', $kelas)->where('mapel', $mapel)
                            ->where('semester', $semester->semester_kode)
                            ->where('ta', $semester->tahun_ajaran)
                            ->where('tag_lock', 'true')->count();
        $final      = Score::where('scores.kelas', $kelas)->where('mapel', $mapel)
                            ->where('semester', $semester->semester_kode)
                            ->where('ta', $semester->tahun_ajaran)
                            ->where('tag_final', 'true')->count();
        return response(['jumlah' => $jumlah, 'isi' => $value, 'final' => $final]);

    }
    public function nilaiAjax($kelas, $mapel)
    {
        $semester = Semester::where('is_active', 'true')->first();
        $data = [
            'count'     => Score::where('kelas', $kelas)->where('mapel', $mapel)
                                ->where('semester', $semester->semester_kode)
                                ->where('ta', $semester->tahun_ajaran)
                                ->count(),
        ];
        return json_encode($data);
    }
    public function tagFinal(Request $request)
    {
        $semester   = Semester::where('is_active', 'true')->first();
        $kelas = $request->kelas;
        $mapel = $request->mapel;
        Score::where('kelas', $kelas)->where('mapel', $mapel)
                            ->where('semester', $semester->semester_kode)
                            ->where('ta', $semester->tahun_ajaran)
                            ->where('user_id', Auth::user()->id)
                            ->update(['tag_final' => 'true']);
        return response(['success' => 'Terkirim...']);
    }
    public function updateNilai(Request $request)
    {
        $request->validate(['idscore' => 'required']);
        $idscore = $request->idscore;
        $nilai  = $request->nilai;
        $deskripsi = $request->deskripsi;
        Score::where('idscore', $idscore)->update([
            'nilai' => $nilai,
            'deskripsi' => $deskripsi,
            'tag_lock' => 'true'
        ]);
    }
    public function unlockNilai(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->id;
        Score::where('idscore', $id)->update(['tag_lock' => 'false']);
        return response(['success' => 'unlocked']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semester = Semester::where('is_active', 'true')->first();
        $load = User::where('kelas', $request->kelas)->where('level', 4)->get();
        $data = array();
        //looping
        foreach($load as $ld){
            $data[] = Score::create([
                'kode_score'        => date('Ymdhis'),
                'kelas'             => $request->kelas,
                'mapel'             => $request->mapel,
                'siswa_id'          => $ld->id,
                'nilai'             => 0,
                'tanggal_penilaian' => date('Y-m-d'),
                'bulan_penilaian'   => date('m'),
                'grouping'          => 1,
                'tag_lock'          => 'false',
                'tag_final'         => 'false',
                'user_id'           => Auth::user()->id,
                'semester'          => $semester->semester_kode,
                'ta'                => $semester->tahun_ajaran,
                'deskripsi'         => 'Catatan...'
            ]);
        }
        
    }

    public function report()
    {
        if(Auth::user()->level == 2){
            $mapel = Mapel::join('gurumapels', 'gurumapels.mapel_id', '=', 'mapels.idmapel')
                        //->where('gurumapels.user_id', Auth::user()->id)
                        ->get();
        }
        if(Auth::user()->level == 1){
            $mapel = Mapel::join('gurumapels', 'gurumapels.mapel_id', '=', 'mapels.idmapel')
                        ->where('mapel_campus', Auth::user()->campus_id)
                        ->get();
        }

        $data = [
            'title'     => 'Laporan Penilaian Siswa',
            'kelas'     => Room::where('campus_id', Auth::user()->campus_id)->get(),
            'semester'  => Semester::select('tahun_ajaran')->orderBy('idsm', 'DESC')->groupByRaw('tahun_ajaran')->get(),
            'mapel'     => $mapel,
        ];
        return view('nilai.report', $data);
    }
    public function report_nilai($ta, $semester, $mapel, $kelas)
    {
        $count = Score::where('ta', $ta)->where('semester', $semester)->where('mapel', $mapel)->where('kelas', $kelas)->count();
        
        if($count != 0){
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
            'result'    => $load,
            'nilai'     => $nilai,
            'count'     => $count,
        ];
        }else{

            $data = [
                'count'     => $count,
            ];
        }
        return view('nilai.tableReport', $data);
    }

    public function report_nilai_siswa($ta, $semester, $kelas, $siswa)
    {
        $count = Score::where('ta', $ta)->where('semester', $semester)->where('siswa_id', $siswa)->where('kelas', $kelas)->count();
        
        if($count != 0){
        $load = Score::join('users', 'users.id', '=', 'scores.siswa_id')
                        ->join('students', 'students.user_id', '=', 'scores.siswa_id')
                        ->where('scores.kelas', $kelas)->where('siswa_id', $siswa)
                        ->where('semester', $semester)
                        ->where('ta', $ta)->get();
        $nilai = Score::join('users', 'users.id', '=', 'scores.siswa_id')
                        ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')
                        ->join('rooms', 'rooms.idkelas', '=', 'scores.kelas')
                        ->where('scores.kelas', $kelas)->where('siswa_id', $siswa)
                        ->where('semester', $semester)
                        ->where('ta', $ta)->first();
        $data = [
            'result'    => $load,
            'nilai'     => $nilai,
            'count'     => $count,
        ];
        }else{

            $data = [
                'count'     => $count,
            ];
        }
        return view('nilai.reportpersiswa', $data);
    }

    /**json data */
    public function ta_semester_json($ta, $semester)
    {
        $data = Score::join('rooms', 'rooms.idkelas', '=', 'scores.kelas')
                        ->where('semester', $semester)->where('ta', $ta)
                        ->select('scores.kelas', 'rooms.kode_kelas')
                        ->groupBy('scores.kelas', 'rooms.kode_kelas')
                        ->get();
        return json_encode($data);
    }
    public function ta_semester_kelas_json($ta, $semester, $kelas)
    {
        $data = Score::join('users', 'users.id', '=', 'scores.siswa_id')
                        ->join('students', 'students.user_id', '=', 'scores.siswa_id')
                        ->where('semester', $semester)->where('ta', $ta)
                        ->where('scores.kelas', $kelas)
                        ->select('siswa_id as id', 'first_name as name', 'nisn')
                        ->groupBy('siswa_id', 'first_name', 'nisn')
                        ->get();
        return json_encode($data);
    }
    public function report_per_siswa($ta, $semester, $kelas, $siswa): View
    {
        $user = User::where('id', $siswa)->select('first_name as name', 'campus_id')->first();
        $data = [
            'result'    => Score::where('ta', $ta)->where('semester', $semester)
                            ->where('kelas', $kelas)->where('siswa_id', $siswa)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')
                            ->select('kode_mapel as kode', 'nama_mapel as mapel', 'nilai', 'deskripsi')
                            ->get(),
            'nilai'     => Score::where('ta', $ta)->where('semester', $semester)
                            ->where('kelas', $kelas)->where('siswa_id', $siswa)
                            ->select('semester', 'ta', 'kelas', 'siswa_id')->first(),
            'student'   => Student::where('user_id', $siswa)->select('nisn')->first(),
            'user'      => $user,
            'kelas'     => Room::where('idkelas', $kelas)->select('kode_kelas')->first(),
            'campus'    => Campu::where('idcampus', $user->campus_id)->select('campus_name')->first(),
            
        ];
        return view('nilai.tablepersiswa', $data);
    }

    /**kalender Pendidikan */
    public function kaldik()
    {
        $data = [
            'title'     => 'Kalender Pendidikan',
            'ta'        => Semester::orderBy('idsm', 'DESC')->limit(10)->get(),
            'campus'    => Campu::all(),
            'hari'      => TanggalKaldik::where('bulan_kaldik_id', '1')->get(),
            'keterangan'=> TagKaldik::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('nilai.kaldik', $data);
    }

    public function kaldikTable($campus, $ta)
    {
        $semester = Semester::where('idsm',$ta)->first();

        $data = [
            'bulan'     => BulanKaldik::where('campus_id', $campus)
                                        ->where('ta', $semester->tahun_ajaran)->get(),
            'hari'      => TanggalKaldik::join('bulan_kaldiks', 'bulan_kaldiks.id', 'tanggal_kaldiks.bulan_kaldik_id')
                                        ->where('bulan_kaldiks.campus_id', $campus)
                                        ->where('ta', $semester->tahun_ajaran)
                                        ->leftJoin('tag_kaldiks', 'tanggal_kaldiks.tag', '=', 'tag_kaldiks.id')
                                        ->select('pekan', 'hari', 'tanggal', 'tag', 'tanggal_kaldiks.id as id',
                                        'bulan_kaldik_id', 'color')
                                        ->get(),
        ];
        return view('nilai.kaldik_bulan', $data);
    }

    public function addKaldikBulan(Request $request)
    {
        $semester = Semester::where('is_active', 'true')->first();
        $dataBulan = [
            'campus_id'     => Auth::user()->campus_id,
            'ta'            => $semester->tahun_ajaran, //dari tabel semester
            'semester'      => $request->semester, //dari tabel semester
            'tahun'         => $request->tahun,
            'bulan'         => $request->bulan,
            'he_sekolah'    => 0,
            'he_semester'   => 0,
            'pe'            => 0,
            'jumlah_pe'     => 0,
            'lock'          => 1,
        ];
        $createBulan = BulanKaldik::create($dataBulan);
        
        $countHari = 35; // Jumlah hari yang telah ditentukan
        $hariDalamSeminggu = 7; // Jumlah hari dalam seminggu
        for ($i = 1; $i <= $countHari; $i++) {
            $week = ceil($i / 7); // Hitung pekan berdasarkan pembagian dengan 7, kemudian dibulatkan ke atas

            // Hitung nilai untuk setiap hari
            $hariDalamPekan = ($i - 1) % $hariDalamSeminggu + 1;

            // Menambahkan data ke dalam database
            $tanggal = new TanggalKaldik();
            $tanggal->bulan_kaldik_id = $createBulan->id;
            $tanggal->tanggal = 0;

            // Tentukan nilai hari berdasarkan nilai dalam pekan
            switch ($hariDalamPekan) {
                case 1:
                    $tanggal->hari = 'Minggu';
                    break;
                case 2:
                    $tanggal->hari = 'Senin';
                    break;
                case 3:
                    $tanggal->hari = 'Selasa';
                    break;
                case 4:
                    $tanggal->hari = 'Rabu';
                    break;
                case 5:
                    $tanggal->hari = 'Kamis';
                    break;
                case 6:
                    $tanggal->hari = 'Jumat';
                    break;
                case 7:
                    $tanggal->hari = 'Sabtu';
                    break;
                default:
                    // Jika jumlah hari dalam seminggu tidak tepat
                    break;
            }
            if($tanggal->hari == 'Minggu'){
                $tanggal->tag = 1;
            }else{
                $tanggal->tag = 0;
            }
            $tanggal->pekan = $week;
            $tanggal->save();
        }

        return response()->json([
            'status'    => 200,
            'message'   => 'Baris ditambahkan',  
        ]);
        
    }

    /**unlock */
    public function kaldikUnlock(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $bulanKaldik = BulanKaldik::findOrFail($request->id);
        $bulanKaldik->update(['lock' => 0]);

        return response()->json([
            'status'    => 200,
        ]);
    }

    /**lock */
    public function kaldikLock(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $bulanKaldik = BulanKaldik::findOrFail($request->id);
        $bulanKaldik->update(['lock' => 1]);

        return response()->json([
            'status'    => 200,
        ]);
    }

    /**update tanggal */
    public function kaldikUpdateTanggal(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'tanggal'   => 'required',
        ]);

        /**Update Tanggal */
        $tanggalKaldik = TanggalKaldik::where('id', $request->id)->first();
        
        //Update Tanggal
        TanggalKaldik::where('id', $request->id)
                    ->update(['tanggal' => $request->tanggal]);

        //load Data
        $data = TanggalKaldik::where('bulan_kaldik_id', $tanggalKaldik->bulan_kaldik_id)
                            ->pluck('tanggal')->toArray();
        $maxDate = max($data);

        BulanKaldik::findOrFail($tanggalKaldik->bulan_kaldik_id)
                    ->update(['he_sekolah' => $maxDate]);
        

        return response()->json([
            'status'    => 200,
            'message'   => 'Updated!',
        ]);
    }

    /**Add Keterangan */
    public function addKeterangan(Request $request)
    {
        $request->validate([
            'keterangan'    => 'required',
            'warna'         => 'required',
        ]);

        TagKaldik::create([
            'campus_id'     => Auth::user()->campus_id,
            'tag_name'      => $request->keterangan,
            'color'         => $request->warna,
        ]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Keterangan berhasil ditambahkan',
        ]);
    }

    /**Load Keterangan */
    public function loadKeterangan(): View
    {
        $data = [
            'result'    => TagKaldik::where('campus_id', Auth::user()->campus_id)
                                ->where('tag_name', '!=', 'Default')->get(),
        ];
        return view('nilai.keteranganKaldik', $data);
    }

    /**Load Keterangan */
    public function loadKeteranganModal()
    {
        $data = TagKaldik::where('campus_id', Auth::user()->campus_id)->get();
        return response()->json($data);
    }

    /**Update Keterangan */
    public function updateKeterangan(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'tag_name'  => 'required',
            'color'     => 'required',
        ]);

        $tagKaldik = TagKaldik::findOrFail($request->id);
        $tagKaldik->update([
            'tag_name'  => $request->tag_name,
            'color'     => $request->color,
        ]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Keterangan diperbaharui!',
        ]);
    }

    /**Add Keterangan Hari */
    public function addKeteranganHari(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'tag'   => 'required',
        ]);

        
        $loadTag = TagKaldik::where('id', $request->tag)->first();
        if($loadTag->tag_name == 'Default'){
            $tagId = 0;
        }else{
            $tagId = $request->tag;
        }
        
        /**Update Tag */
        $kalidHari = TanggalKaldik::findOrFail($request->id);
        $kalidHari->update(['tag' => $tagId]);



        /**Load Data */
        $data = TanggalKaldik::where('id', $request->id)->first();

        /**Hitung total hari efektif */
        $count = DB::table('tanggal_kaldiks')
                    ->where('bulan_kaldik_id', $data->bulan_kaldik_id)
                    ->where('tanggal', '!=', 0)
                    ->where('tag', 0)
                    ->distinct()
                    ->count('pekan');

        $countPekan = $count ?? 0;

        /**Update Minggu Efektif */
        $bulan = BulanKaldik::findOrFail($data->bulan_kaldik_id);
        $bulan->update(['pe' => $countPekan]);

        //load Hari Efektif
        $loadHe = TanggalKaldik::where('bulan_kaldik_id', $data->bulan_kaldik_id)
                            ->pluck('tanggal')->toArray();
        $he = max($loadHe ?? 0);

        //load Hari Non Efektif
        $loadHne = TanggalKaldik::where('bulan_kaldik_id', $data->bulan_kaldik_id)
                                    ->where('tanggal', '!=', 0)
                                    ->where('tag', '!=', 0)
                                    ->count(); 
        $hne = $loadHne ?? 0;
        $hariEfektif = $he-$hne;

        /**Update Hari Efektif */
        $bulanHe = BulanKaldik::findOrFail($data->bulan_kaldik_id);
        $bulanHe->update(['he_sekolah' => $hariEfektif]);


        /**Update Semester Efektif */
        $bulanHeSemester = BulanKaldik::findOrFail($data->bulan_kaldik_id)->first();
        $this->heSemesterUpdate($bulanHeSemester->tahun, $bulanHeSemester->semester); //update jumlah hari dalam semester
        $this->updateJumlahPekan($bulanHeSemester->tahun, $bulanHeSemester->semester); //update jumlah pekan dama 1 semester

        return response()->json([
            'status'    => 200,
            'message'   => 'Updated.',
        ]);
    }

    /**Delete Keterangan */
    public function deleteKeterangan(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        /** Update Tag */
        TanggalKaldik::where('tag', $request->id)
                        ->update(['tag' => 0]);

        $delete = TagKaldik::findOrFail($request->id);
        $delete->delete();

        return response()->json([
            'status'    => 200,
            'message'   => 'Deleted.',
        ]);
    }


    /**Delete Bulan */
    public function deleteBulan(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $bulan = BulanKaldik::findOrFail($request->id);
        $bulan->delete();

        TanggalKaldik::where('bulan_kaldik_id', $request->id)->delete();

        return response()->json([
            'status'    => 200,
            'message'   => 'Deleted.',
        ]);
    }

    /**Hitung hari efektif semester */
    public function heSemesterUpdate($tahun, $semester)
    {
        $data  = BulanKaldik::join('tanggal_kaldiks', 'bulan_kaldiks.id', '=', 'tanggal_kaldiks.bulan_kaldik_id')
                                    ->where('campus_id', Auth::user()->campus_id)
                                    ->where('tahun', $tahun)
                                    ->where('semester', $semester)
                                    ->where('tanggal', '!=', 0)
                                    ->where('tag', 0)
                                    ->count();
        $count = $data ?? 0;
        
        return BulanKaldik::where('campus_id', Auth::user()->campus_id)
                                ->where('tahun', $tahun)
                                ->where('semester', $semester)
                                ->update([
                                    'he_semester'   => $count,
                                ]);

    }

    /**Hitung total pekan dalam 1 semester */
    public function updateJumlahPekan($tahun, $semester)
    {
        $data = BulanKaldik::where('tahun', $tahun)->where('semester', $semester)
                                ->sum('pe');
        $countPe = $data ?? 0;

        return BulanKaldik::where('tahun', $tahun)->where('semester', $semester)
                                ->update([
                                    'jumlah_pe' => $countPe,    
                                ]);
    }



    /**
     * TK
     * ************************************
     */

    public function uploadKaldikTK(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file'          => 'required|file|mimes:png,jpg,jpeg,svg|max:500',
            'campus_id'     => 'required',
            'file_name'     => 'required',
            'ta'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 422,
                'success'   => false, 
                'errors'    => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $ekstensi   = $file->getClientOriginalExtension();
            $randomName = rand(1111, 9999);
            $filename   = 'tk-kaldik'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
            $path       = 'tk/kaldik/'.$filename;
            // Simpan file ke penyimpanan Laravel
            Storage::disk('public')->put($path,file_get_contents($file));

            $data = [
                'files'     => $filename,
                'campus_id' => $request->campus_id,
                'file_name' => $request->file_name,
                'ta'        => $request->ta,
            ];

            TkKaldik::create($data);

            return response()->json([
                'status'    => 200,
                'message'   => 'Kalender berhasil diupload!',
            ], 200);

        } else {
            return response()->json([
                'status' => 403, 
                'message' => 'File tidak ditemukan.'
            ], 403);
        }
    }

    public function loadFileKaldikTK($campus, $ta):View
    {
        $data = [
            'item'    => TkKaldik::where('campus_id', $campus)->where('ta', $ta)->first(),
            'count'    => TkKaldik::where('campus_id', $campus)->where('ta', $ta)->count(),
        ];
        return view('nilai.tk_file_kaldik', $data);
    }

    public function deleteKaldikTK(Request $request)
    {
        $request->validate(['id' => 'required']);
        $kaldikTK = TkKaldik::findOrFail($request->id);
        $kaldikTK->delete();

        return response()->json([
            'status' => 200, 
            'message' => 'File dihapus.!'
        ], 200);
    }
    /**
     * END TK
     * ************************************
     */

    
    /**Perangkat Pendidikan */
    public function perangkatPembelajaran():view
    {
        $data = [
            'title'     => 'Perangkat Pembelajaran',
            'campus'    => Campu::all(),
            'ta'        => Semester::all(),
        ];
        return view('nilai.perangkatPembelajaran', $data);
    }

    public function pbSilabus($campus, $ta):View
    {
        $data = [
            'silabus'       => Silabus::where('campus_id', $campus)->where('ta', $ta)->first(),
            'countSilabus'  => Silabus::where('campus_id', $campus)->where('ta', $ta)->count(),
        ];
        return view('nilai.pb.silabus', $data);
    }
    public function pbProta($campus, $ta):View
    {
        $data = [
            'prota'       => Prota::where('campus_id', $campus)->where('ta', $ta)->first(),
            'countProta'  => Prota::where('campus_id', $campus)->where('ta', $ta)->count(),
        ];
        return view('nilai.pb.prota', $data);
    }
    public function pbProsem($campus, $ta):View
    {
        $data = [
            'prosem'       => Prosem::where('campus_id', $campus)->where('ta', $ta)->first(),
            'countProsem'  => Prosem::where('campus_id', $campus)->where('ta', $ta)->count(),
        ];
        return view('nilai.pb.prosem', $data);
    }

    public function pbUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'          => 'required|file|mimes:png,jpg,jpeg,svg|max:500',
            'campus_id'     => 'required',
            'ta'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 422,
                'success'   => false, 
                'errors'    => $validator->errors()
            ], 422);
        }

        $table = $request->table;

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $ekstensi   = $file->getClientOriginalExtension();
            $randomName = rand(1111, 9999);
            $filename   = 'pb'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
            $path       = 'pb/'.$filename;
            // Simpan file ke penyimpanan Laravel
            Storage::disk('public')->put($path,file_get_contents($file));

            $data = [
                'file'      => $filename,
                'campus_id' => $request->campus_id,
                'ta'        => $request->ta,
                'update_by' => Auth::user()->id,
            ];

            if($table == 'Silabus'){
                Silabus::create($data);
            }elseif($table == 'Prota'){
                Prota::create($data);
            }elseif($table == 'Prosem'){
                Prosem::create($data);
            }

            return response()->json([
                'status'    => 200,
                'message'   => 'File berhasil diupload!',
            ], 200);

        } else {
            return response()->json([
                'status' => 403, 
                'message' => 'File tidak ditemukan.'
            ], 403);
        }
    }

    public function pbDelete(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $id = $request->id;

        if($request->table == 'Prota'){
            $prota = Prota::findOrFail($id);
            $prota->delete();
        }elseif($request->table == 'Prosem'){
            $prosem = Prosem::findOrFail($id);
            $prosem->delete();
        }elseif($request->table == 'Silabus'){
            $silabus = Silabus::findOrFail($id);
            $silabus->delete();
        }

        return response()->json([
            'status' => 200, 
            'message' => 'File dihapus.'
        ], 200);
    }
    /**End Perangkat Pendidikan */


    /**Testing Json */
    public function testingJson($tahun, $semester)
    {
        //$tanggalKaldik = TanggalKaldik::where('bulan_kaldik_id', $id)->first();
        //$bulanKaldik = BulanKaldik::where('id', $tanggalKaldik->bulan_kaldik_id)->first();

        $data = [
            'he_semester'  => BulanKaldik::where('tahun', $tahun)->where('semester', $semester)
            ->sum('pe'),
        ];


        return response()->json($data);
    }

}
