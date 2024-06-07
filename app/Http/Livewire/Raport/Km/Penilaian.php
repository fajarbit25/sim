<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\Campu;
use App\Models\Gurumapel;
use App\Models\KompetensiDasar;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penilaian extends Component
{
    public $loading = false;
    public $campus;
    public $ta;
    public $semester;
    public $kelas;
    public $aspek;
    public $mapel;

    public $dataCampus;
    public $dataTa;
    public $dataKelas;
    public $dataMapel;
    public $dataNilai;
    public $dataKd;

    public function mount()
    {
        $this->getDataCampus();
    }

    public function loadAll()
    {
        $this->getDataTa();
        $this->getDataKelas();
        $this->getDataMapel();
        $this->getDataNilai();
        if($this->kelas){
            $this->getDataKd();
        }
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.km.penilaian');
    }

    public function getDataCampus()
    {
        if(Auth::user()->campus_id == 1){
            $data = Campu::all();
        }else{
            $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        }
        $this->dataCampus = $data;
    }

    public function getDataTa()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(10)->get();
        $this->dataTa = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', $this->campus)->orderBy('tingkat', 'ASC')->get();
        $this->dataKelas = $data;
    }

    public function getDataMapel()
    {
        $data = Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                        ->where('user_id', Auth::user()->id)
                        ->select('idmapel', 'kode_mapel', 'nama_mapel')->get();
        $this->dataMapel = $data;
    }

    public function createNilai()
    {
        $users = User::where('kelas', $this->kelas)->select('id as userid')->get();
        $loadKelas = Room::where('idkelas', $this->kelas)->select('tingkat')->first();
        foreach($users as $user){
            $dataKd = KompetensiDasar::where('ta', $this->ta)->where('semester', $this->semester)
                                ->where('kelas', $loadKelas->tingkat)->where('aspek', $this->aspek)
                                ->where('idmapel', $this->mapel)
                                ->select('id as idkd')->get();
            if(count($dataKd) == 0){
                session()->flash('message', 'TP untuk Mata Pelajaran yang Dipilih Belum Ada!');
            }else{
                foreach($dataKd as $kd){
                    SdNilaiPelajaran::create([
                        'ta'        => $this->ta,
                        'semester'  => $this->semester,
                        'user_id'   => $user->userid,
                        'mapel_id'  => $this->mapel,
                        'aspek'     => $this->aspek,
                        'kd'        => $kd->idkd,
                        'nilai'     => 0,
                    ]);
                }
            }
        }
    }

    public function getDataNilai()
    {
        $data = SdNilaiPelajaran::leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                        ->leftJoin('registers', 'registers.user_id', '=', 'sd_nilai_pelajarans.user_id')
                        ->join('kompetensi_dasars', 'kompetensi_dasars.id', 'sd_nilai_pelajarans.kd')
                        ->where('sd_nilai_pelajarans.ta', $this->ta)->where('sd_nilai_pelajarans.semester', $this->semester)
                        ->where('mapel_id', $this->mapel)->where('sd_nilai_pelajarans.aspek', $this->aspek)
                        ->where('users.kelas', $this->kelas)
                        ->select('first_name', 'nick_name', 'nis', 'kode', 'nilai', 'users.id as idsiswa',  
                        'sd_nilai_pelajarans.id as id_nilai', 'sd_nilai_pelajarans.kd as idkd', 'tampil')->get();
        $this->dataNilai = $data;
    }

    public function getDataKd()
    {
        $loadKelas = Room::where('idkelas', $this->kelas)->select('tingkat')->first();
        $data = KompetensiDasar::where('aspek', $this->aspek)
                        ->where('kelas', $loadKelas->tingkat)
                        ->where('idmapel', $this->mapel)->get();
        $this->dataKd = $data;
    }

    public function lihatKd($id)
    {
        $data = SdNilaiPelajaran::findOrFail($id);
        if($data->tampil == null){
            $data->update([
                'tampil'    => 1,
            ]);
        }else{
            $data->update([
                'tampil'    => null,
            ]);
        }
    }

    public function updateNilai($id)
    {
        $data = SdNilaiPelajaran::findOrFail($id);
        if($data->nilai == 0){
            $data->update([
                'nilai'     => 1,
            ]);
        }else{
            $data->update([
                'nilai'     => 0,
            ]);
        }
    }

}
