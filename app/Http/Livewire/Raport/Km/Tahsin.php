<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\Room;
use App\Models\Semester;
use App\Models\TahsinKd;
use App\Models\TahsinNilai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tahsin extends Component
{
    public $loading = false;
    public $kode;
    public $bahasa;
    public $arabic;
    public $ta;
    public $semester;
    public $jenis;
    public $kelas;

    public $dataSemester;
    public $dataKelas;
    public $dataNilai;
    public $dataNilaiAkhir;
    public $dataKd;
    public $idEditKd = '0';
    public $idDeleteKd = '0';
    public $nilai;


    public function loadAll()
    {
        $this->getDataSemester();
        $this->getDataKelas();
        if($this->ta && $this->semester && $this->jenis && $this->kelas){
            $this->getDataNilai();
            $this->getDataNilaiAkhir();
            $this->getDataKd();
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
                    ->select('id', 'kode', 'bahasa', 'arabic')->get();
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
    }

    public function confirmDeleteKd($id)
    {
        $this->idEditKd = '0';
        $this->idDeleteKd = $id;
        $kd = TahsinKd::findOrFail($this->idDeleteKd);

        $this->kode = $kd->kode;
        $this->bahasa = $kd->bahasa;
        $this->arabic = $kd->arabic;
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
        ]);

        $data = [
            'kode' => $this->kode,
            'bahasa' => $this->bahasa,
            'arabic' => $this->arabic,
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
                TahsinNilai::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'kelas'     => $this->kelas,
                    'user_id'   => $user->id,
                    'nilai'     => 0,
                    'kd_id'     => $item->id,
                    'jenis_penilaian' => $this->jenis,
                    'campus_id' => Auth::user()->campus_id, 
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
                    ->select('users.id', 'first_name', 'nis', 'nilai', 'arabic', 'tahsin_nilais.kd_id', 'tahsin_nilais.id as id_nilai')
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
    }
}
