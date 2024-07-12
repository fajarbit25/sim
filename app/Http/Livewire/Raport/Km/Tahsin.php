<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\Room;
use App\Models\Semester;
use App\Models\TahsinCatatan;
use App\Models\TahsinGuru;
use App\Models\TahsinKd;
use App\Models\TahsinNilai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tahsin extends Component
{
    public $loading = false;
    public $notif;
    public $kode;
    public $bahasa;
    public $arabic;
    public $kkm;
    public $ta;
    public $semester;
    public $jenis;
    public $kelas;
    public $saran;
    public $idSaran;

    public $dataSemester;
    public $dataKelas;
    public $dataNilai;
    public $dataNilaiAkhir;
    public $dataKd;
    public $idEditKd = '0';
    public $idDeleteKd = '0';
    public $nilai;
    public $idGuruTahsin;
    public $dataGuru;
    public $guruTahsin;
    public $catatanTahsin;
    public $tanggalRaport;
    public $tanggalRaportNew;


    public function loadAll()
    {
        $this->getDataSemester();
        $this->getGuruTahsin();
        $this->getDataKelas();
        $this->getDataGuru();
        if($this->ta && $this->semester && $this->jenis && $this->kelas){
            $this->getDataNilai();
            $this->getDataNilaiAkhir();
            $this->getDataKd();
            $this->getCatatanTahsin();
        }
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.km.tahsin');
    }

    public function modalKd()
    {
        $this->getDataKd();
        $this->emit('modalKd');
    }

    public function getDataSemester()
    {
        $semester = Semester::orderBy('idsm', 'DESC')->limit(10)->select('tahun_ajaran')->get();
        $this->dataSemester = $semester;
    }

    public function getDataKelas()
    {
        $kelas = Room::where('campus_id', Auth::user()->campus_id)->select('idkelas', 'tingkat', 'kode_kelas')->get();
        $this->dataKelas = $kelas;
    }

    public function saveKd()
    {
        $this->validate([
            'ta'        => 'required',
            'semester'  => 'required',
            'kelas'     => 'required',
            'kode'      => 'required',
            'bahasa'    => 'required',
            'arabic'    => 'required',
        ]);

        $kelas = Room::findOrFail($this->kelas);

        TahsinKd::create([
            'campus_id'     => Auth::user()->campus_id,
            'ta'            => $this->ta,
            'semester'      => $this->semester,
            'tingkat'       => $kelas->tingkat,
            'kode'          => $this->kode,
            'arabic'        => $this->arabic,
            'bahasa'        => $this->bahasa,
            'kkm'           => $this->kkm,
        ]);

        $this->getDataKd();
        $this->resetFormKd();

    }

    public function getDataKd()
    {
        $kelas = Room::findOrFail($this->kelas);
        $kd = TahsinKd::where('campus_id', Auth::user()->campus_id)
                    ->where('ta', $this->ta)->where('semester', $this->semester)
                    ->where('tingkat', $kelas->tingkat)
                    ->select('id', 'kode', 'bahasa', 'arabic', 'kkm')->get();
        $this->dataKd = $kd;
    }

    public function editKd($id)
    {
        $this->idEditKd = $id;
        $this->idDeleteKd = '0';
        $kd = TahsinKd::findOrFail($this->idEditKd);

        $this->kode = $kd->kode;
        $this->bahasa = $kd->bahasa;
        $this->arabic = $kd->arabic;
        $this->kkm = $kd->kkm;
    }

    public function confirmDeleteKd($id)
    {
        $this->idEditKd = '0';
        $this->idDeleteKd = $id;
        $kd = TahsinKd::findOrFail($this->idDeleteKd);

        $this->kode = $kd->kode;
        $this->bahasa = $kd->bahasa;
        $this->arabic = $kd->arabic;
        $this->kkm = $kd->kkm;
    }

    public function destroyKd()
    {
        $this->validate([
            'idDeleteKd'    => 'required',  
        ]);

        $kd = TahsinKd::findOrFail($this->idDeleteKd);
        $kd->delete();
        $this->idDeleteKd = '0';
        $this->resetFormKd();
        $this->getDataKd();
    }

    public function cancelDestroyKd()
    {
        $this->idDeleteKd = '0';
        $this->resetFormKd();
    }

    public function updateKd()
    {
        $this->validate([
            'ta'        => 'required',
            'semester'  => 'required',
            'kelas'     => 'required',
            'kode'      => 'required',
            'bahasa'    => 'required',
            'arabic'    => 'required',
            'kkm'       => 'required',
        ]);

        $data = [
            'kode' => $this->kode,
            'bahasa' => $this->bahasa,
            'arabic' => $this->arabic,
            'kkm'   => $this->kkm,
        ];

        $kd = TahsinKd::findOrFail($this->idEditKd);
        $kd->update($data);

        $this->idEditKd = '0';
        $this->resetFormKd();
        $this->getDataKd();
    }

    public function createForm()
    {
        $this->validate([
            'ta'        => 'required',
            'semester'  => 'required',
            'kelas'     => 'required',
            'jenis'     => 'required',
        ]);

        $kelas = Room::findOrFail($this->kelas);
        $users = User::where('kelas', $this->kelas)->select('id')->get();
        foreach($users as $user){
            $kd = TahsinKd::where('campus_id', Auth::user()->campus_id)
                        ->where('ta', $this->ta)->where('semester', $this->semester)
                        ->where('tingkat', $kelas->tingkat)->select('id')->get();
            foreach($kd as $item){

                //Cek Nilai
                $cekNilai = TahsinNilai::where('ta', $this->ta)->where('semester', $this->semester)
                                ->where('kelas', $this->kelas)->where('user_id', $user->id)
                                ->where('jenis_penilaian', $this->jenis)->where('kd_id', $item->id)
                                ->count();
                if($cekNilai == 0){
                    TahsinNilai::create([
                        'ta'        => $this->ta,
                        'semester'  => $this->semester,
                        'kelas'     => $this->kelas,
                        'user_id'   => $user->id,
                        'nilai'     => 0,
                        'kd_id'     => $item->id,
                        'jenis_penilaian' => $this->jenis,
                        'campus_id' => Auth::user()->campus_id, 
                        'tanggal_raport' => date('Y-m-d'),
                    ]);
                }
            }

            //Cek Catatan
            $cekCatatan = TahsinCatatan::where('ta', $this->ta)->where('semester', $this->semester)
                                ->where('kelas', $this->kelas)->where('user_id', $user->id)->count();
            if($cekCatatan == 0){
                TahsinCatatan::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'kelas'     => $this->kelas,
                    'user_id'   => $user->id,
                    'catatan'   => '-',
                    'tanggal_rapor' => date('Y-m-d'),
                ]);
            }

        }

        $this->getDataNilai();
        $this->getDataNilaiAkhir();
    }

    public function getDataNilai()
    {
        $nilai = TahsinNilai::join('users', 'users.id', '=', 'tahsin_nilais.user_id')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('tahsin_kds', 'tahsin_kds.id', '=', 'tahsin_nilais.kd_id')
                    ->where('tahsin_nilais.campus_id', Auth::user()->campus_id)
                    ->where('tahsin_nilais.ta', $this->ta)->where('tahsin_nilais.semester', $this->semester)
                    ->where('tahsin_nilais.kelas', $this->kelas)->select('tahsin_nilais.id')
                    ->where('jenis_penilaian', $this->jenis)
                    ->select('users.id', 'first_name', 'nis', 'nilai', 'arabic', 'tahsin_nilais.kd_id', 'tahsin_nilais.id as id_nilai', 'kode')
                    ->get();
        $this->dataNilai = $nilai;
    }

    public function getDataNilaiAkhir()
    {
        $nilaiAkhir = TahsinNilai::join('users', 'users.id', '=', 'tahsin_nilais.user_id')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('tahsin_kds', 'tahsin_kds.id', '=', 'tahsin_nilais.kd_id')
                    ->where('tahsin_nilais.campus_id', Auth::user()->campus_id)
                    ->where('tahsin_nilais.ta', $this->ta)->where('tahsin_nilais.semester', $this->semester)
                    ->where('tahsin_nilais.kelas', $this->kelas)->select('tahsin_nilais.id')
                    ->select('users.id', 'nilai', 'tahsin_nilais.id as id_nilai')
                    ->get();
        $this->dataNilaiAkhir = $nilaiAkhir;
    }

    public function updateNilai($id)
    {
        $this->validate([
            'nilai'     => 'required|integer|min:60|max:99',
        ]);
        $nilai = TahsinNilai::findOrFail($id);
        $nilai->update(['nilai' => $this->nilai, ]);
        $this->nilai = "";
        $this->getDataNilai();
        $this->getDataNilaiAkhir();
    }

    public function resetFormKd()
    {
        $this->kode = "";
        $this->bahasa = "";
        $this->arabic = "";
        $this->kkm = "";
    }

    public function getDataGuru()
    {
        $data = User::where('level', 2)->where('campus_id', Auth::user()->campus_id)
                    ->select('id', 'first_name')->get();
        $this->dataGuru = $data;
    }

    public function savaGuruTahsin()
    {
        $this->validate([
            'idGuruTahsin'      => 'required',
        ]);

        $cek = TahsinGuru::where('campus_id', Auth::user()->campus_id)->where('user_id', $this->idGuruTahsin)->where('kelas', $this->kelas)->count();

        if($cek == 0){
            TahsinGuru::create([
                'campus_id'     => Auth::user()->campus_id,
                'kelas'         => $this->kelas,
                'user_id'       => $this->idGuruTahsin,
            ]);
            $this->emit('closeModal');
            $this->notif = [
                'status'    => 200,
                'message'   => 'Guru ditambahkan!',
            ];
        }else{
            $this->notif = [
                'status'    => 500,
                'message'   => 'Guru telah didaftarkan!',
            ];
        }
        
        $this->showAlert();

    }

    public function addGuruTahsin()
    {
        $this->emit('modalGuruTahsin');
    }

    public function getGuruTahsin()
    {
        $guru = TahsinGuru::join('users', 'users.id', '=', 'tahsin_gurus.user_id')
                        ->where('users.campus_id', Auth::user()->campus_id)
                        ->where('kelas', $this->kelas)
                        ->select('tahsin_gurus.id', 'first_name')->get();
        $this->guruTahsin = $guru;
    }

    public function deleteGuruTahsin($id)
    {
        $guru = TahsinGuru::findOrFail($id);
        $guru->delete();
    }

    public function getCatatanTahsin()
    {
        $data = TahsinCatatan::where('ta', $this->ta)->where('semester', $this->semester)->where('kelas', $this->kelas)
                    ->select('user_id', 'catatan', 'id', 'tanggal_rapor')->get();
        $tanggal = TahsinCatatan::where('ta', $this->ta)->where('semester', $this->semester)->where('kelas', $this->kelas)
                    ->select('user_id', 'catatan', 'id', 'tanggal_rapor')->first();
        $this->catatanTahsin = $data;
        $this->tanggalRaport = $tanggal->tanggal_rapor ?? '0000-00-00';
    }

    public function updateTanggalRaport()
    {
        TahsinCatatan::where('ta', $this->ta)->where('semester', $this->semester)
        ->where('kelas', $this->kelas)
        ->update([
            'tanggal_rapor'     => $this->tanggalRaportNew,
        ]);

        $this->notif = [
            'status'    => 200,
            'message'   => 'Tanggal Rapor Diubah menjadi '.$this->tanggalRaportNew,
        ];
        $this->showAlert();
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }

    public function modalSaran($id)
    {
        $this->idSaran = $id;
        $getSaran = TahsinCatatan::findOrFail($this->idSaran);
        $this->saran = $getSaran->catatan;
        $this->emit('modalSaran');
    }

    public function updateSaran()
    {
        $saran = TahsinCatatan::findOrFail($this->idSaran);
        $saran->update([
            'catatan'   => $this->saran,
        ]);
        $this->emit('closeModal');
    }
}
