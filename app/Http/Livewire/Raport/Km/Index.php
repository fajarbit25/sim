<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $loading = false;
    public $semester;
    public $kelas;
    public $ta;

    public $dataSemester = [];
    public $dataKelas;
    public $dataNilai;
    public $detailSemester;

    public function mount()
    {
        $this->getDataSemester();
    }

    public function loadAll()
    {
        $this->getDataKelas();
        if($this->semester){
            $this->getDetailSemester();
        }

        if($this->kelas){
            $this->getDataNilai();
        }
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.km.index');
    }

    public function getDataNilai()
    {
        $data =  SdNilaiPelajaran::leftJoin('mapels', 'mapels.idmapel', '=', 'sd_nilai_pelajarans.mapel_id')
                            ->leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                            ->leftJoin('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                            ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                            ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                            ->where('users.kelas', $this->kelas)
                            ->where('sd_nilai_pelajarans.aspek', 'Sumatif')
                            ->select('users.id as iduser', 'first_name', 'nick_name', 'nilai', 'mapel_id', 'sd_nilai_pelajarans.id as idraport',
                            'mapels.kode_mapel')
                            ->get();
        $this->dataNilai = $data;

    }

    public function getDataSemester()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(10)->get();
        $this->dataSemester = $data->toArray();
    }

    public function getDataKelas()
    {
        $campus = $this->campus();
        $data = Room::where('campus_id', $campus)->orderBy('tingkat', 'ASC')->get();
        $this->dataKelas = $data;
    }

    public function campus()
    {
        return Auth::user()->campus_id;
    }

    public function getDetailSemester()
    {
        $data = Semester::findOrFail($this->semester);
        $this->detailSemester = $data;
    }
}
