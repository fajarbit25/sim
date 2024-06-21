<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Campu;
use App\Models\Confirmpayment;
use App\Models\Document;
use App\Models\Formulirinformation;
use App\Models\Invoice;
use App\Models\Kesejahteran;
use App\Models\Ppdb;
use App\Models\Prestasi;
use App\Models\Priodik;
use App\Models\Register;
use App\Models\Scholarship;
use App\Models\User;
use App\Models\Special_need;
use App\Models\Student;
use App\Models\Wali;
use App\Models\Ppdbmaster;
use App\Models\Tipetransaction;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Svg\Tag\Rect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PpdbController extends Controller
{
    public function smkit_ppdb():view
    {
        $data = [
            'title'         => 'Pendaftaran PPDB SMKIT IQIS',
            'contact'       => Campu::where('idcampus', 1)->first(),
            'info'          => Formulirinformation::where('campus_id', 5)->first(),
            'cek_master'    => Ppdbmaster::where('idpm', 1)->first(),
        ];
        return view('ppdb.smkit', $data);
    }
    public function smpit_ppdb():view
    {
        $data = [
            'title'         => 'Pendaftaran PPDB SMPIT IQIS',
            'contact'       => Campu::where('idcampus', 4)->first(),
            'info'          => Formulirinformation::where('campus_id', 4)->first(),
            'cek_master'    => Ppdbmaster::where('idpm', 1)->first(),
        ];
        return view('ppdb.smpit', $data);
    }
    public function sdit_ppdb():view
    {
        $data = [
            'title'         => 'Pendaftaran PPDB SDIT IQIS',
            'contact'       => Campu::where('idcampus', 3)->first(),
            'info'          => Formulirinformation::where('campus_id', 3)->first(),
            'cek_master'    => Ppdbmaster::where('idpm', 1)->first(),
        ];
        return view('ppdb.sdit', $data);
    }
    public function tkit_ppdb():view
    {
        $data = [
            'title'         => 'Pendaftaran PPDB TKIT IQIS',
            'contact'       => Campu::where('idcampus', 2)->first(),
            'info'          => Formulirinformation::where('campus_id', 2)->first(),
            'cek_master'    => Ppdbmaster::where('idpm', 1)->first(),
        ];
        return view('ppdb.sdit', $data);
    }

    /**Register PPDB */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'first_name'    => 'required|min:3',
            'email'         => 'required|unique:users',
            'phone'         => 'required|min:10|unique:users',
            'password'      => 'required',
        ]);

        // Mendapatkan path URL
        $campus_id = $request->campus_id;

        if($campus_id == 2){
            $url = 'tkit';
        }elseif($campus_id == 3){
            $url = 'sdit';
        }elseif($campus_id == 4){
            $url = 'smpit';
        }elseif($campus_id == 5){
            $url = 'smkit';
        }

        //Cek Status PPDB
        $loadMaster = Ppdbmaster::where('idpm', 1)->first();
        if($loadMaster->status == 'Ditutup'){
            return redirect('/'.$url.'/ppdb')
            ->with(['warning' => 'PPDB telah ditutup!']);
        }

        $data = [
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'level'         => 4,
            'status'        => 'PPDB',
            'phone'         => $request->phone,
            'photo'         => 'https://sim.iqis.sch.id/storage/photo-users/user.png',
            'campus_id'     => $request->campus_id,
            'password'      => Hash::make($request->password),
            'kelas'         => 0,
        ];
        $user = User::create($data);

        /** Generate Nomor Pendaftaran */
        $nomorAwal = "1021";
        $nomorTengah = 1000+$user->id;
        $nomorAkhir = "0001001";
        $nomor_pendaftaran = $nomorAwal.$nomorTengah.$nomorAkhir;

        /**Deklarasi data jenjang pendidikan */
        if($campus_id == 2){
            $jenjang = 'TK/PAUD';
        }elseif($campus_id == 3){
            $jenjang = 'SD';
        }elseif($campus_id == 4){
            $jenjang = 'SMP';
        }elseif($campus_id == 5){
            $jenjang = 'SMA/Sederajat';
        }

        $ppdb = [
            'user_id'               => $user->id,
            'nomor_pendaftaran'     => $nomor_pendaftaran,
            'nomor_formulir'        => $nomorTengah,
            'lokasi_pendaftaran'    => 'Online',
            'jalur'                 => '-',
            'jenjang'               => $jenjang,
            'status'                => 1,
        ];

        Ppdb::create($ppdb);

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

        $student = [
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
        Student::create($student);

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
        Alamat::create($alamat);

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
            'nis'           => NULL,
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

        //ambil data tipe transaksi
        $loadtt = Tipetransaction::where('campus_id', Auth::user()->campus_id)
                                    ->where('tipe', 'PPDB')->first();
                                

        $middleCode = $user->id+1000;
        $invoice = [
            'user_id'           => $user->id,
            'jenis_transaksi'   => 'IN',  
            'tipe_transaksi'    => $loadtt->tipe,
            'kode_transaksi'    => date('y').$middleCode.rand(1111, 9999),
            'nomor_invoice'     => date('y').rand(1111, 9999),
            'invoice_date'      => date('Y-m-d'),
            'amount'            => 350000,
            'invoice_status'    => 'UNPAID',
            'description'       => 'Pembayaran uang Pendaftaran Penerimaan Siswa Baru '.$user->first_name.' / '.$user->email.' Ibnul Qayyim Islamic School Makassar',
            'campus_id'         => $request->campus_id,
        ];
        Invoice::create($invoice);
        return redirect('/'.$url.'/ppdb')->with(['success' => 'Registrasi berhasil silahkan Login!']);
        
    }

    /**Form PPDB Pembayaran*/
    public function ppdb()
    {
        $progresBar = ['percent' => 10, 'valueNow' => 10, 'valueMax' => 100];
        $invoice = Invoice::where('user_id', Auth::user()->id)->where('tipe_transaksi', 1)->first();
        $data = [
            'title'     => 'PPDB SMKIT - Ibnul Qayyim',
            'user'      => User::findOrFail(Auth::user()->id),
            'invoice'   => $invoice,
        ];

        if($invoice->invoice_status == 'UNPAID'){
            return view('ppdb.pendaftaran', $data, $progresBar);
        }else{
            return redirect('/ppdb/upload_dokument');
        }
    }
    /** Confirm Payment */
    public function payment(Request $request):RedirectResponse
    {
        Validator::validate($request->all(), [
            'file'    => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png', 'pdf'])->max(20000),
            ],
            'nama_pengirim' => 'required',
            'rek_pengirim'  => 'required',
            'bank'          => 'required',
            'invoice_id'    => 'required',
            'campus_id'     => 'required',
        ]);

        $loadInvocie = Invoice::where('idiv', $request->invoice_id)->first();
        
        /**Upload Foto */
        $photo      = $request->file('file');
        $ekstensi   = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'trx_'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'confirm-payment/'.$filename;

        $payment = [
            'invoice_id'    => $request->invoice_id,
            'amount'        => $loadInvocie->amount,
            'name'          => $request->nama_pengirim,
            'account_id'    => $request->rek_pengirim,
            'bank_name'     => $request->bank,
            'confirm_status'=> 0,
            'confirm_by'    => NULL,
            'evidence'      => $filename,
            'campus_id'     => Auth::user()->campus_id,
        ];

        Storage::disk('public')->put($path,file_get_contents($photo));
        Confirmpayment::create($payment);

        Invoice::where('idiv', $request->invoice_id)->update(['invoice_status' => 'PENDING']);

        return redirect('/ppdb/upload_dokument');
    }

    /**Upload Dokumen */
    public function upload():View
    {
        //$progresBar = ['percent' => 20, 'valueNow' => 20, 'valueMax' => 100];
        $data = [
            'title'     => 'PPDB SMKIT Upload Dokument',
            'progresBar'=> ['percent' => 20, 'valueNow' => 20, 'valueMax' => 100],
            'user'      => User::findOrFail(Auth::user()->id),
            'doc'       => Document::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.upload_document', $data);
    }

    /**Form Upload */
    public function form_upload():view
    {
        $data = [
            'doc'       => Document::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.form_upload_doc', $data);
    }

    /**Upload Akta Lahir */
    public function upload_akta_lahir(Request $request)
    {
        $validator = Validator::validate($request->all(), [
            'akta_lahir' => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png', 'pdf'])->max(20000),
            ]
        ]);

        $photo      = $request->file('akta_lahir');
        $ekstensi   = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'akta_'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'document/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));
        Document::where('user_id', Auth::user()->id)->update(['akta_lahir'  => $filename]);
        return response(['success' => 'Akta lahir berhasil di upload']);
    }
    
    /**Upload KK */
    public function upload_kk(Request $request)
    {
        Validator::validate($request->all(), [
            'kartu_keluarga'    => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png', 'pdf'])->max(20000),
            ]
        ]);
        $files      = $request->file('kartu_keluarga');
        $ekstensi   = $files->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'kk_'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'document/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($files));
        Document::where('user_id', Auth::user()->id)->update(['kk'  => $filename]);
        return response(['success' => 'Kartu Keluarga berhasil di upload']);
    }

    /**Upload KTP Orang Tua */
    public function ktp_ortu(Request $request)
    {
        Validator::validate($request->all(), [
            'ktp_ortu'    => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png', 'pdf'])->max(20000),
            ]
        ]);
        $files      = $request->file('ktp_ortu');
        $ekstensi   = $files->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'ktp_'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'document/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($files));
        Document::where('user_id', Auth::user()->id)->update(['ktp_ortu'  => $filename]);
        return response(['success' => 'KTP Orang Tua berhasil di upload']);
    }

    /** Upload Pas Foto */
    public function pas_foto(Request $request)
    {
        Validator::validate($request->all(), [
            'foto'    => [
                'required',
                File::types(['img', 'png', 'jpg', 'jpeg'])->max(20000),
            ]
        ]);
        $files      = $request->file('foto');
        $ekstensi   = $files->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = 'foto_'.date('Ymdhis').'-'.$randomName.'.'.$ekstensi;
        $path       = 'document/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($files));
        Document::where('user_id', Auth::user()->id)->update(['foto'  => $filename]);
        return response(['success' => 'Pas Foto berhasil di upload']);
    }

    /**Delete Document */
    public function delete_document(Request $request)
    {
        $field = $request->field;
        Document::where('user_id', Auth::user()->id)->update([$field => NULL]);
        return response(['success' => 'Dokumen dihapus, Silahkan Upload Kembali!']);
    }
    public function get_fileCount()
    {
        $data = Document::where('user_id', Auth::user()->id)->get();
        return json_encode($data);
    }


    /**Store Biodata */
    public function submit_biodata(Request $request):RedirectResponse
    {
        $validator = $request->validate([
            'gender'            => 'required',
            'nisn'              => 'required|max:10',
            'nik'               => 'required|max:16',
            'kk'                => 'required|max:16',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'akta_lahir'        => 'required',
            'agama'             => 'required',
            'kewarganegaraan'   => 'required',
            'negara'            => 'required',
            'anak_ke'           => 'required',
        ]);

        $updateName = User::where('id', Auth::user()->id)->update(['first_name' => $request->name]);

        $data = [
            'gender'            => $request->gender,
            'nisn'              => $request->nisn,
            'nik'               => $request->nik,
            'kk'                => $request->kk,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'akta_lahir'        => $request->akta_lahir,
            'agama'             => $request->agama,
            'kewarganegaraan'   => $request->kewarganegaraan,
            'negara'            => $request->negara,
            'anak_ke'           => $request->anak_ke,
            'no_kks'            => $request->no_kks,
            'penerima_kip'      => $request->penerima_kip,
            'no_kip'            => $request->no_kip,
            'nama_kip'          => $request->nama_kip,
            'alasan_menolak_kip'=> $request->alasan_menolak_kip,
            'penerima_kps'      => $request->penerima_kps,
            'nomor_kps'         => $request->nomor_kps,
        ];

        $store = Student::where('user_id', Auth::user()->id)->update($data);
        return redirect('/ppdb/alamat');
    }

    /**Biodata */
    public function biodata():View
    {
        $progresBar = ['percent' => 30, 'valueNow' => 30, 'valueMax' => 100];
        $data = [
            'title'     => 'PPDB SMKIT Pengisian Biodata',
            'user'      => User::findOrFail(Auth::user()->id),
            'student'   => Student::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.biodata', $data, $progresBar);
    }

    /**Alamat */
    public function alamat():View
    {
        $progresBar = ['percent' => 40, 'valueNow' => 40, 'valueMax' => 100];
        $data = [
            'title'     => 'PPDB SMKIT Informasi Tempat Tinggal',
            'user'      => User::findOrFail(Auth::user()->id),
            'alamat'    => Alamat::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.alamat', $data, $progresBar);
    }
    public function store_alamat(Request $request):RedirectResponse
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
        ]);

        if($request->lintang == null){
            $lintang = "kosong";
        }else{
            $lintang = $request->lintang;
        }
        if($request->bujur == null){
            $bujur = "kosong";
        }else{
            $bujur = $request->bujur;
        }

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
            'lintang'                   => $lintang,
            'bujur'                     => $bujur,
        ];
        Alamat::where('user_id', Auth::user()->id)->update($data);
        return redirect('/ppdb/ayah');
    }


    /**Informasi Ayah */
    public function ayah():View
    {
        $progresBar = ['percent' => 50, 'valueNow' => 50, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Informasi Ayah',
            'user'      => User::findOrFail(Auth::user()->id),
            'wali'      => Wali::where('user_id', Auth::user()->id)->where('segment', 'ayah')->first(),
        ];
        return view('ppdb.ayah', $data, $progresBar);
    }
    public function store_wali(Request $request):RedirectResponse
    {
        $request->validate([
            'nama_lengkap'  => 'required',
            'nik'           => 'required',
            'tahun_lahir'   => 'required|max:4|min:4',
            'pekerjaan'     => 'required',
            'penghasilan'   => 'required',
            'segment'       => 'required',
        ]);
        $data = [
            'nik'                   => $request->nik,
            'nama_lengkap'          => $request->nama_lengkap,
            'tahun_lahir'           => $request->tahun_lahir,
            'pendidikan'            => $request->pendidikan,
            'pekerjaan'             => $request->pekerjaan,
            'penghasilan'           => $request->penghasilan,
            'keb_khusus'            => $request->keb_khusus,
        ];
        Wali::where('user_id', Auth::user()->id)->where('segment', $request->segment)->update($data);
        if($request->segment == 'ayah'){
            return redirect('/ppdb/ibu');
        }
        if($request->segment == 'ibu'){
            return redirect('/ppdb/wali');
        }
        if($request->segment == 'wali'){
            return redirect('/ppdb/kontak');
        }
    }

    /**Informasi Ibu */
    public function Ibu():View
    {
        $progresBar = ['percent' => 60, 'valueNow' => 60, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Informasi Ibu',
            'user'      => User::findOrFail(Auth::user()->id),
            'wali'      => Wali::where('user_id', Auth::user()->id)->where('segment', 'ibu')->first(),
        ];
        return view('ppdb.ibu', $data, $progresBar);
    }

    /**Informasi Wali */
    public function wali():View
    {
        $progresBar = ['percent' => 70, 'valueNow' => 70, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Informasi Wali',
            'user'      => User::findOrFail(Auth::user()->id),
            'wali'      => Wali::where('user_id', Auth::user()->id)->where('segment', 'wali')->first(),
        ];
        return view('ppdb.wali', $data, $progresBar);
    }

    /**Kontak */
    public function kontak()
    {
        $progresBar = ['percent' => 80, 'valueNow' => 80, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Informasi Wali',
            'user'      => User::findOrFail(Auth::user()->id)
        ];
        return view('ppdb.kontak', $data, $progresBar);
    }
    public function store_kontak(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'phone'     => 'required|max:14|min:9',
            'telephone' => 'required|max:14|min:9',
            'email'     => 'required|email',
        ]); 
        User::where('id', Auth::user()->id)->update($validated);
        return redirect('/ppdb/priodik');
    }

    /**Data priodik */
    public function priodik():view
    {
        $progresBar = ['percent' => 90, 'valueNow' => 90, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Informasi Wali',
            'user'      => User::findOrFail(Auth::user()->id),
            'priodik'   => Priodik::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.priodik', $data, $progresBar);
    }
    public function store_priodik(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'tinggi'            => 'required|max:3',
            'berat'             => 'required|max:3',
            'lingkar_kepala'    => 'required|max:2',
            'jarak_per_1km'     => 'required',
            'jarak'             => 'required|max:3',
            'jam'               => 'required|max:2',
            'menit'             => 'required|max:2',
            'saudara'           => 'required|max:2',
        ]);
        Priodik::where('user_id', Auth::user()->id)->update($validated);
        return redirect('/ppdb/prestasi');
    }

    /**Prestasi */
    public function prestasi():view
    {
        $progresBar = ['percent' => 95, 'valueNow' => 95, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Prestasi',
            'user'      => User::findOrFail(Auth::user()->id),
            'prestasi'  => Prestasi::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.prestasi', $data, $progresBar);
    }
    public function store_prestasi(Request $request)
    {
        $data = [
            'user_id'           => Auth::user()->id,
            'nama_prestasi'     => $request->nama_prestasi,
            'jenis'             => $request->jenis,
            'tingkat'           => $request->tingkat,
            'tahun'             => $request->tahun,
            'penyelenggara'     => $request->penyelenggara,
        ];
        Prestasi::create($data);
        return response(['success'  => 'Prestasi berhasil ditambahkan!']);
    }
    public function table_prestasi()
    {
        $data = [
            'prestasi'  => Prestasi::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.table_prestasi', $data);
    }
    public function delete_prestasi(Request $request)
    {
        $request->validate([
            'idprestasi'  => 'required',
        ]);
        Prestasi::where('idprestasi', $request->idprestasi)->delete();
        return response(['success' => 'Data prestasi dihapus!']);
    }


    /**Beasiswa */
    public function beasiswa():view
    {
        $progresBar = ['percent' => 95, 'valueNow' => 95, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Beasiswa',
            'user'      => User::findOrFail(Auth::user()->id),
            'beasiswa'  => Scholarship::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.beasiswa', $data, $progresBar);
    }
    public function store_beasiswa(Request $request)
    {
        $data = [
            'user_id'        => Auth::user()->id,
            'jenis'          => $request->jenis,
            'tahun_mulai'    => $request->tahun_mulai,
            'tahun_selesai'  => $request->tahun_selesai,
            'keterangan'     => $request->keterangan,
        ];
        Scholarship::create($data);
        return response(['success'  => 'Beasiswa berhasil ditambahkan!']);
    }
    public function table_beasiswa()
    {
        $data = [
            'beasiswa'  => Scholarship::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.table_beasiswa', $data);
    }
    public function delete_beasiswa(Request $request)
    {
        $request->validate([
            'idss'  => 'required',
        ]);
        Scholarship::where('idss', $request->idss)->delete();
        return response(['success' => 'Data beasiswa dihapus!']);
    }

    /**Kesejahteraan */
    public function kesejahteraan():view
    {
        $progresBar = ['percent' => 98, 'valueNow' => 98, 'valueMax' => 100];
        $data = [
            'title'             => 'PPBD SMKIT Kesejahteraan Peserta Didik',
            'user'              => User::findOrFail(Auth::user()->id),
            'kesejahteraan'     => Kesejahteran::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.kesejahteraan', $data, $progresBar);
    }
    public function table_kesejahteraan()
    {
        $data = [
            'kesejahteraan'  => Kesejahteran::where('user_id', Auth::user()->id)->get(),
        ];
        return view('ppdb.table_kesejahteraan', $data);
    }
    public function store_kesejahteraan(Request $request)
    {
        $data = [
            'user_id'       => Auth::user()->id,
            'jenis'         => $request->jenis,
            'nama'          => $request->nama,
            'nomor_kartu'   => $request->nomor_kartu,
        ];
        Kesejahteran::create($data);
        return response(['success' => 'Data berhasil ditambahkan!']);
    }
    public function delete_kesejahteraan(Request $request)
    {
        $request->validate([
            'idks'  => 'required',
        ]);
        Kesejahteran::where('idks', $request->idks)->delete();
        return response(['success' => 'Data Kesejahteraan dihapus!']);
    }


    /**Registrasi */
    public function registrasi():view
    {
        $progresBar = ['percent' => 99, 'valueNow' => 99, 'valueMax' => 100];
        $data = [
            'title'     => 'Registrasi Peserta Didik Baru',
            'register'  => Register::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.register', $data, $progresBar);
    }
    public function store_registrasi(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'jenis'                 => 'required',
        ]);
        Register::where('user_id', Auth::user()->id)->update($validated);
        User::where('id', Auth::user()->id)->update(['status'  => 0]);
        return redirect('ppdb/selesai')->with(['success' => 'Proses proses registrasi selesai']);
    }

    /**Informasi Question */
    public function question():View
    {
        $progresBar = ['percent' => 80, 'valueNow' => 80, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Pertanyaan Singkat',
            'user'      => User::findOrFail(Auth::user()->id),
        ];
        return view('ppdb.question', $data, $progresBar);
    }

    /** Pernyataan */
    public function pernyataan():View
    {
        $progresBar = ['percent' => 90, 'valueNow' => 90, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Pernyataan',
            'user'      => User::findOrFail(Auth::user()->id),
        ];
        return view('ppdb.pernyataan', $data, $progresBar);
    }

    /** Finish */
    public function finish():View
    {
        $load_public_token = Student::where('user_id', Auth::user()->id)->first();
        $link_validation_qrcode = 'https://sim.iqis.sch.id/ppdb/validate/'.$load_public_token->public_token.'/data_validation';

        $progresBar = ['percent' => 100, 'valueNow' => 100, 'valueMax' => 100];
        $data = [
            'title'     => 'PPBD SMKIT Selesai',
            'user'      => User::findOrFail(Auth::user()->id),
            'student'   => Student::where('user_id', Auth::user()->id)->first(),
            'alamat'    => Alamat::where('user_id', Auth::user()->id)->first(),
            'register'  => Register::where('user_id', Auth::user()->id)->first(),
            'prestasi'  => Prestasi::where('user_id', Auth::user()->id)->get(),
            'qrcode'    => QrCode::size(150)->generate($link_validation_qrcode),
            'doc'       => Document::where('user_id', Auth::user()->id)->first(),
            'ppdb'      => Ppdb::where('user_id', Auth::user()->id)->first(),
            'priodik'   => Priodik::where('user_id', Auth::user()->id)->first(),
            'master'    => Ppdbmaster::where('idpm', 1)->first(),
        ];
        return view('ppdb.finish', $data, $progresBar);
    }

    public function data_validation($id)//: View
    {
        $data = [
            'title'     => 'Document Validation',
            'user'      => Student::join('users', 'users.id', '=', 'students.user_id')->where('public_token', $id)->first(),
            'cek'       => Student::where('public_token', $id)->count(),
        ];
        return view('ppdb.data_validation', $data);

    }

    public function pdf()
    {
        $data = [
            'title'     => 'PPBD SMKIT',
            'user'      => User::findOrFail(Auth::user()->id),
            'student'   => Student::where('user_id', Auth::user()->id)->first(),
            'alamat'    => Alamat::where('user_id', Auth::user()->id)->first(),
            'register'  => Register::where('user_id', Auth::user()->id)->first(),
            'prestasi'  => Prestasi::where('user_id', Auth::user()->id)->get(),
            'qrcode'    => QrCode::size(150)->generate(Auth::user()->email),
            'doc'       => Document::where('user_id', Auth::user()->id)->first(),
            'ppdb'      => Ppdb::where('user_id', Auth::user()->id)->first(),
        ];
        return view('ppdb.pdf', $data);
    }

    /** Form Kebutuhan Khusus */
    public function form_keb_khusus($segment)
    {
        $data = [
            'khusus'    => Special_need::where('user_id', Auth::user()->id)->where('segment', 'siswa')->get(),
        ];
        return view('ppdb.form_keb_khusus', $data);
    }

    public function form_keb_khusus_wali($segment)
    {
        $data = [
            'khusus'    => Special_need::where('user_id', Auth::user()->id)->where('segment', $segment)->get(),
        ];
        return view('ppdb.form_keb_khusus_wali', $data);
    }

    public function add_keb_khusus(Request $request)
    {
        $data = [
            'user_id'           => Auth::user()->id,
            'segment'           => $request->segment,
            'special_needs'     => $request->kebutuhan_khusus,
        ];
        Special_need::create($data);
        return response(['success' => $request->kebutuhan_khusus.' Berhasil ditambahkan']);
    }
    public function del_keb_khusus(Request $request)
    {
        Validator::validate($request->all(), [
            'id'    => ['required'],
        ]);
        Special_need::where('idsn', $request->id)->delete();
        return response(['success'  => 'Data Kebutuhan Khusus Telah Dihapus.!']);
    }

    public function json_alamat($id)
    {
        $data = Alamat::where('user_id', $id)->first();
        echo json_encode($data);
    }
}

