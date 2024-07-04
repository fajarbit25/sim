<?php

namespace App\Http\Livewire\Absen;

use App\Models\Absen;
use App\Models\Campu;
use App\Models\Room;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WaliKelasReport extends Component
{
    public $loading = false;
    public $campus;
    public $ta;
    public $semester;
    public $kelas;
    public $public;

    public $dataCampus;
    public $dataTa;
    public $dataKelas;
    public $dataAbsen;
    public $hide = 1;


    public function loadAll()
    {
        $this->getDataCampus();
        $this->getDataTa();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.absen.wali-kelas-report');
    }

    public function getDataCampus()
    {
        if(Auth::user()->campus_id == 1){
            $data = Campu::all();
        }else{
            $data = Campu::where('idcampus', Auth::user()->campus_id)->select('idcampus', 'campus_name')->get();
        }
        $this->dataCampus = $data;
    }

    public function getDataTa()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(15)->select('tahun_ajaran')->get();
        $this->dataTa = $data;
    }

    public function updatedcampus()
    {
        $this->getDataKelas();
        $this->kelas = null;
        $this->ta = null;
        $this->semester = null;
    }

    public function updatedkelas()
    {
        $this->ta = null;
        $this->semester = null;
    }

    public function updatedta()
    {
        $this->semester = null;
    }
    
    public function getDataKelas()
    {
        $data = Room::where('campus_id', $this->campus)->orderBy('tingkat', 'ASC')->get();
        $this->dataKelas = $data;
    }

    public function updatedSemester()
    {
        $this->getDataAbsen();   
    }

    public function getDataAbsen()
    {
        $data = Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                ->join('registers', 'registers.user_id', '=', 'absens.siswa_id')
                ->where('ta', $this->ta)->where('absens.campus_id', $this->campus)
                ->where('absens.kelas', $this->kelas)->where('semester', $this->semester)
                ->select('first_name', 'nis', 'nisn', 'absensi', 'users.id as user_id', 'tanggal_absen')->get();
        $this->dataAbsen = $data;
    }

    public function hideData()
    {
        $this->hide = 1;
        $this->getDataAbsen();
    }

    public function unhideData()
    {
        $this->hide = 0;
        $this->getDataAbsen();
    }

}
