<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Document;
use App\Models\Priodik;
use App\Models\Register;
use App\Models\User;
use App\Models\Student;
use App\Models\Room;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Imports\ImportSiswa;
use App\Models\Ppdb;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('guru');
        //$this->middleware('proses');
    }

    public function index():view
    {
        $data = [
            'title'     => 'Siswa',
            'kelas'     => Room::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('siswa.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|min:3',
            'email'         => 'required|unique:users|email',
            'nisn'          => 'required|unique:students|min:8',
            'nis'           => 'required|unique:registers|min:6',
            'phone'         => 'required|unique:users',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'gender'        => 'required',
        ]);

        //Generate Password
        $inputPassword = $request->tanggal_lahir;
        $password = substr($inputPassword, 8, 2).substr($inputPassword, 5, 2).substr($inputPassword, 0, 4);

        $data =[
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'telephone'     => NULL,
            'level'         => 4,
            'status'        => 1,
            'photo'         => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'     => Auth::user()->campus_id,
            'kelas'         => 0,
            'password'      => Hash::make($password),
        ];
        $user = User::create($data);

        $dataStudent = [
            'user_id'       => $user->id,
            'room_id'       => 0,
            'gender'        => $request->gender,
            'nisn'          => $request->nisn,
            'nik'           => NULL,
            'kk'            => NULL,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'akta_lahir'    => NULL,
            'agama'         => NULL,
            'kewarganegaraan'=> NULL,
            'negara'        => NULL,
            'anak_ke'       => NULL,
            'pekerjaan_pelajar'=> NULL,
            'penerima_kip'  => NULL,
            'no_kip'        => NULL,
            'nama_kip'      => NULL,
            'alasan_menolak_kip' => NULL,
            'no_kks'        => NULL,
            'penerima_kps'  => NULL,
            'nomor_kps'     => NULL,
            'layak_pip'     => NULL,
            'alasan_layak_pip'  => NULL,
            'public_token'  => $request->_token, 
        ];


        $alamat = [
            'user_id'               => $user->id,
            'provinsi'              => NULL,
            'kota'                  => NULL,
            'kec'                   => NULL,
            'kel'                   => NULL,
            'rt'                    => NULL,
            'rw'                    => NULL,
            'kode_pos'              => NULL,
            'jalan'                 => NULL,
            'status_tempat_tinggal' => NULL,
            'moda_transportasi'     => NULL,
            'lintang'               => NULL,
            'bujur'                 => NULL,
        ];

        $document = [
            'user_id'       => $user->id,
            'akta_lahir'    => NULL,
            'kk'            => NULL,
            'ktp_ortu'      => NULL,
            'ktp'           => NULL,
            'foto'          => NULL,
            'updated_by'    => $user->id,
        ];
        Document::create($document);

        $ayah = [
            'user_id'               => $user->id,
            'segment'               => 'ayah',
            'nama_lengkap'          => NULL,
            'nik'                   => NULL,
            'tahun_lahir'           => NULL,
            'pendidikan'            => NULL,
            'pekerjaan'             => NULL,
            'penghasilan'           => NULL,
            'keb_khusus'            => NULL,
        ];
        $ibu = [
            'user_id'               => $user->id,
            'segment'               => 'ibu',
            'nama_lengkap'          => NULL,
            'nik'                   => NULL,
            'tahun_lahir'           => NULL,
            'pendidikan'            => NULL,
            'pekerjaan'             => NULL,
            'penghasilan'           => NULL,
            'keb_khusus'            => NULL,
        ];
        $wali = [
            'user_id'               => $user->id,
            'segment'               => 'wali',
            'nama_lengkap'          => NULL,
            'nik'                   => NULL,
            'tahun_lahir'           => NULL,
            'pendidikan'            => NULL,
            'pekerjaan'             => NULL,
            'penghasilan'           => NULL,
            'keb_khusus'            => NULL,
        ];
        Wali::create($ayah);
        Wali::create($ibu);
        Wali::create($wali);

        $priodik = [
            'user_id'               => $user->id,
            'tinggi'                => NULL,
            'berat'                 => NULL,
            'lingkar_kepala'        => NULL,
            'jarak_per_1km'         => NULL,
            'jarak'                 => NULL,
            'jam'                   => NULL,
            'menit'                 => NULL,
            'saudara'               => NULL,
        ];
        Priodik::create($priodik);
        
        $register = [
            'user_id'       => $user->id,
            'kompetensi'    => NULL,
            'jenis'         => NULL,
            'nis'           => $request->nis,
            'tanggal_masuk' => NULL,
            'npsn_sekolah'  => NULL,
            'sekolah_asal'  => NULL,
            'nomor_ujian'   => NULL,
            'nomor_ijazah'  => NULL,
            'nomor_skhu'    => NULL,
            'bahasa_indonesia' => NULL,
            'matematika'    => NULL,
            'ipa'           => NULL,
        ];
        Register::create($register);
    
        Alamat::create($alamat);
        Student::create($dataStudent);

        $dataPpbd = [
            'user_id'           => $user->id,
            'nomor_pendaftaran' => time(),
            'lokasi_pendaftaran'=> 'Sekolah',
            'nomor_formulir'    => '-',
            'jalur'             => 'Zonasi',
            'jenjang'           => '-',
            'status'            => 200,
        ];
        Ppdb::create($dataPpbd);

        return redirect()->intended('/siswa')->with(['success' => 'Data berhasil disimpan']);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);

        $id = $request->id;
        User::where('id', $id)->delete();
        //return redirect()->intended('/siswa')->with(['success' => 'Data telah dihapus!']); 
        return response()->json([
            'status'    => 200,
            'message'   => 'Data siswa dihapus!',
        ]);
    }

    public function show($id):view
    {
        $data = [
            'title'     => 'Detail Siswa',
            'siswa'     => User::where('id', $id)
                                ->join('campus', 'campus.idcampus', '=', 'users.campus_id')
                                ->join('levels', 'levels.idlevel', '=', 'users.level')->first(),
            'student'   => Student::where('user_id', $id)->first(),
            'room'      => Room::all(),
            'alamat'    => Alamat::where('user_id', $id)->first(),
            'doc'       => Document::where('user_id', $id)->first(),
        ];
        return view('siswa.show', $data);
    }

    public function detail($id):View
    {
        $data = [
            'siswa'      => User::where('id', $id)->join('students', 'students.user_id', '=', 'users.id')->first(),
        ];
        return view('siswa.detail', $data);
    }

    public function changeImage(Request $request)
    {
        $photo = $request->file('photo');
        $ekstensi = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path = 'photo-users/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $id = $request->id;
        $data = [
            'photo'     => $filename,
        ];

        User::where('id', $id)->update($data);
    }

    public function updateInformasi(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);
        $id = $request->id;
        $dataUser = [
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'telephone'     => $request->telephone,
        ];
        
        $dataStudent = [
            'gender'        => $request->gender,
            'nik'           => $request->nik,
            'kk'            => $request->kk,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'akta_lahir'    => $request->akta_lahir,
            'agama'         => $request->agama,
            'no_kks'        => $request->no_kks,
            'penerima_kip'  => $request->penerima_kip,
            'no_kip'        => $request->no_kip,
            'nama_kip'      => $request->nama_kip,
            'alasan_menolak_kip'    => $request->alasan_menolak_kip,
            'penerima_kps'  => $request->penerima_kps,
            'nomor_kps'     => $request->nomor_kps,
            'alasan_layak_pip'  => $request->alasan_layak_pip,
        ];
        User::where('id', $id)->update($dataUser);
        Student::where('user_id', $id)->update($dataStudent);
        return response(['success' => 'Informasi Updated!']);

    }

    public function updatePriodik(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);
        $data = [
            'tinggi'            => $request->tinggi,
            'berat'             => $request->berat,
            'lingkar_kepala'    => $request->lingkar_kepala,
            'jarak_per_1km'     => $request->jarak_per_1km,
            'jarak'             => $request->jarak,
            'jam'               => $request->jam,
            'menit'             => $request->menit,
            'saudara'           => $request->saudara,
        ];
        Priodik::where('user_id', $request->id)->update($data);
        return response(['success' => 'Data priodik berhasil diupdate!']);
    }

    public function updateAlamat(Request $request)
    {
        $request->validate([
            'daPro'                     => 'required',
            'daKab'                     => 'required',
            'daKec'                     => 'required',
            'daKel'                     => 'required',
            'rt'                        => 'required',
            'rw'                        => 'required',
            'kode_pos'                  => 'required',
            'jalan'                     => 'required',
            'status_tempat_tinggal'     => 'required',
            'moda_transportasi'         => 'required',
            'lintang'                   => 'required',
            'bujur'                     => 'required',
        ]);

        $data = [
            'provinsi'                  => $request->daPro,
            'idprovinsi'                => $request->provinsi,
            'kota'                      => $request->daKab,
            'idkota'                    => $request->kabupaten,
            'kec'                       => $request->daKec,
            'idkec'                     => $request->kecamatan,
            'kel'                       => $request->daKel,
            'idkel'                     => $request->kelurahan,
            'rt'                        => $request->rt,
            'rw'                        => $request->rw,
            'kode_pos'                  => $request->kode_pos,
            'jalan'                     => $request->jalan,
            'status_tempat_tinggal'     => $request->status_tempat_tinggal,
            'moda_transportasi'         => $request->moda_transportasi,
            'lintang'                   => $request->lintang,
            'bujur'                     => $request->bujur,
        ];
        Alamat::where('user_id', $request->id)->update($data);
        return response(['success' => 'Data berhasil di update!']);
    }

    public function updateRegistrasi(Request $request)
    {
        $request->validate([
            'id'    => 'required',
        ]);
        $data = [
            'kompetensi'    => $request->kompetensi,
            'jenis'         => $request->jenis,
            'nis'           => $request->nis,
            'tanggal_masuk' => $request->tanggal_masuk,
            'sekolah_asal'  => $request->sekolah_asal,
            'nomor_ijazah'  => $request->nomor_ijazah,
            'nomor_ujian'   => $request->nomor_ujian,
            'nomor_skhu'    => $request->nomor_skhu,
        ];

        Register::where('user_id', $request->id)->update($data);
        return response(['success' => 'Data registrasi diupdate!']);
    }

    public function updateAyah(Request $request)
    {
        $request->validate([
            'id'        => 'required',
        ]);

        $id = $request->id;
        $data = [
            'nama_lengkap'=> $request->nama,
            'nik'       => $request->nik,
            'tahun_lahir'     => $request->tahun_lahir,
            'pendidikan'=> $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan'=> $request->penghasilan,
        ];
        Wali::where('user_id', $id)->where('segment', 'ayah')->update($data);
        return response(['success'  => 'Data berhasil di update!']);
    }

    public function updateIbu(Request $request)
    {
        $request->validate([
            'id'        => 'required',
        ]);

        $id = $request->id;
        $data = [
            'nama_lengkap'=> $request->nama,
            'nik'       => $request->nik,
            'tahun_lahir'     => $request->tahun_lahir,
            'pendidikan'=> $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan'=> $request->penghasilan,
        ];
        Wali::where('user_id', $id)->where('segment', 'ibu')->update($data);
        return response(['success'  => 'Data berhasil di update!']);
    }

    public function updateWali(Request $request)
    {
        $request->validate([
            'id'        => 'required',
        ]);

        $id = $request->id;
        $data = [
            'nama_lengkap'=> $request->nama,
            'nik'       => $request->nik,
            'tahun_lahir'     => $request->tahun_lahir,
            'pendidikan'=> $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan'=> $request->penghasilan,
        ];
        Wali::where('user_id', $id)->where('segment', 'wali')->update($data);
        return response(['success'  => 'Data berhasil di update!']);
    }

    public function informasi($id):view
    {
        //load data siswa
        $data_siswa = User::findOrFail($id);
        $kelas = $data_siswa->kelas;
        $data = [
            'title'     => 'Informasi Siswa',
            'siswa'     => User::findOrFail($id),
            'rooms'     => Room::where('idkelas', $kelas)->first(),
        ];
        return view('siswa.informasi', $data);
    }

    /**json */
    public function load($id)
    {
        $load      = User::where('id', $id)
                        ->join('levels', 'levels.idlevel', '=', 'users.level')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->first();
        return json_encode($load);
    }
    public function priodik_json($id)
    {
        $data = Priodik::where('user_id', $id)->first();
        return json_encode($data);
    }
    public function register_json($id)
    {
        $data = Register::where('user_id', $id)->first();
        return json_encode($data);
    }
    public function ayah_json($id)
    {
        $data = Wali::where('user_id', $id)->where('segment', 'ayah')->first();
        return json_encode($data);
    }
    public function ibu_json($id)
    {
        $data = Wali::where('user_id', $id)->where('segment', 'ibu')->first();
        return json_encode($data);
    }
    public function wali_json($id)
    {
        $data = Wali::where('user_id', $id)->where('segment', 'wali')->first();
        return json_encode($data);
    }
    /**End json */

    /**Api alamat */
    public function getApiProvinsi()
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return $data;
    }
    public function getApiProvinceSingle($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/province/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiRegencies($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiRegencySingle($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regency/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiDistricts($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiDistrictSingle($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/district/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiVillages($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$id.'.json');
        return json_encode($data);
    }
    public function getApiVillageSingle($id)
    {
        $data = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/village/'.$id.'.json');
        return json_encode($data);
    }
    /**End Api alamat */

    /**Import Siswa */
    public function importSiswa():view
    {
        $data = [
            'title' => 'Import Siswa',
        ];
        return view('siswa.import', $data);
    }
    
    public function importSiswaProses(Request $request)
    {
        //validasi form input
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');
        $ekstensi = $file->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        //$filename = rand(1111, 9999).$file->getClientOriginalName();
        $path = 'siswa-excel/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($file));
        //Excel::import(new ImportSiswa, asset('storage/siswa-excel/'.$filename));
        Excel::import(new ImportSiswa, $file);
        return redirect('/siswa')->with(['success' => 'Data berhasil diimport..']);
    }
}
