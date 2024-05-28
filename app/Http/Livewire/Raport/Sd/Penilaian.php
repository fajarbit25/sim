<?php

namespace App\Http\Livewire\Raport\Sd;

use App\Models\Gurumapel;
use App\Models\Mapel;
use App\Models\Room;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penilaian extends Component
{
    public $loading = false;
    public $ta;
    public $semester;
    public $kelas;
    public $mapel;
    public $aspek;

    public $dataKelas;
    public $dataSiswa;
    public $dataMapel;
    public $dataNilai;

    public function mount()
    {
        $this->getDataSemester();
    }
    public function loadAll()
    {
        $this->getDataSiswa();
        $this->getDataKelas();
        $this->getDataMapel();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.sd.penilaian');
    }

    public function getDataMapel()
    {
        $data = Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                        ->where('gurumapels.campus_id', Auth::user()->campus_id)
                        ->select('kode_mapel', 'nama_mapel', 'mapel_id')->get();
        $this->dataMapel = $data;
    }

    public function getDataSemester()
    {
        $data = Semester::where('is_active', 'true')->first();
        $this->ta = $data->tahun_ajaran;
        $this->semester = $data->semester_kode;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $data;
    }

    public function getDataSiswa()
    {
        $data = User::where('kelas', $this->kelas)->get();
        $this->dataKelas = $data;
    }

    public function getDataNilai()
    {
        
    }
}
