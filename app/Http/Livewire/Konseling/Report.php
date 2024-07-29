<?php

namespace App\Http\Livewire\Konseling;

use App\Models\Campu;
use App\Models\Konseling;
use App\Models\Room;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $campus;
    public $ta;
    public $semester;
    public $kelas = "";

    public $dataSemester;
    public $dataCampus;
    public $dataKelas;


    public $dataKonseling;


    public function loadAll()
    {
        $this->getDataSemester();
        $this->getDataCampus();
        $this->getDataKelas();
        if($this->kelas == ""){
            $this->getDataKonseling();
        }else{
            $this->getDataKonselingKelas();
        }
    }
    public function render()
    {
        $this->loadAll();
        return view('livewire.konseling.report');
    }

    public function modalFilter()
    {
        $this->emit('modalFilter');
    }

    public function getDataCampus()
    {
        if(Auth::user()->level == 0){
            $data = Campu::all();
        }else{
            $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        }
        $this->dataCampus = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', $this->campus)->get();
        $this->dataKelas = $data;
    }

    public function getDataSemester()
    {
        $data = Semester::limit(20)->get();
        $this->dataSemester = $data;
    }

    public function getDataKonseling()
    {
        $data = Konseling::join('users', 'users.id', '=', 'konselings.user_id')
                ->join('konseling_points', 'konseling_points.id', '=', 'konselings.pelanggaran_id')
                ->join('registers', 'registers.user_id', '=', 'konselings.user_id')
                ->join('students', 'students.user_id', '=', 'konselings.user_id')
                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                ->where('konselings.campus_id', $this->campus)
                ->where('konselings.ta', $this->ta)
                ->where('konselings.semester', $this->semester)
                ->select('konselings.id', 'nis', 'gender', 'first_name', 'tingkat', 'kode_kelas', 'gender', 'point', 'users.id as userid')
                ->orderBy('tingkat', 'ASC')->get();
        $this->dataKonseling = $data;
    }

    public function getDataKonselingKelas()
    {
        $data = Konseling::join('users', 'users.id', '=', 'konselings.user_id')
                ->join('konseling_points', 'konseling_points.id', '=', 'konselings.pelanggaran_id')
                ->join('registers', 'registers.user_id', '=', 'konselings.user_id')
                ->join('students', 'students.user_id', '=', 'konselings.user_id')
                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                ->where('konselings.campus_id', $this->campus)
                ->where('konselings.ta', $this->ta)
                ->where('konselings.semester', $this->semester)
                ->where('konselings.kelas', $this->kelas)
                ->select('konselings.id', 'nis', 'gender', 'first_name', 'tingkat', 'kode_kelas', 'gender', 'point', 'users.id as userid')
                ->get();
        $this->dataKonseling = $data;
    }
}
