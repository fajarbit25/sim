<?php

namespace App\Http\Livewire\Tk\RaportMid;

use App\Models\Campu;
use App\Models\RaportMidTkNilai;
use App\Models\Room;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading = false;
    public $userId;

    public $campus;
    public $ta;
    public $semester;
    public $kelas;
    public $siswa;

    public $dataCampus;
    public $dataKelas;
    public $dataSiswa;
    public $dataTa;
    protected $dataRaport = [];

    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->getDataCampus();
    }

    public function loadAll()
    {
        $this->getDataKelas();
        $this->getDataSiswa();
        $this->getDataTa();
        $this->getDataRaport();
    }
    public function render()
    {
        $this->loadAll();
        
        return view('livewire.tk.raport-mid.main', [
            'dataRaport'    => $this->dataRaport,
        ]);
    }

    public function getDataCampus()
    {
        if(Auth::user()->level == 0){
            $data = Campu::where('idcampus', '!=', 0)->get();
        } else {
            $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        }
        $this->dataCampus = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', $this->campus)
                    ->select('idkelas as id', 'kode_kelas')->get();
        $this->dataKelas = $data;
    }

    public function getDataSiswa()
    {
        $data = User::where('campus_id', $this->campus)->where('kelas', $this->kelas)
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->select('id', 'first_name', 'nis')->get();
        $this->dataSiswa = $data;
    }

    public function getDataTa()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(20)->get();
        $this->dataTa = $data;
    }

    public function getDataRaport()
    {

        $data = User::leftJoin('raport_mid_tks', function($join) {
            $join->on('raport_mid_tks.user_id', '=', 'users.id')
                 ->where('campus', $this->campus)
                 ->where('ta', $this->ta)
                 ->where('semester', $this->semester);
        })
        ->leftJoin('registers', 'registers.user_id', '=', 'users.id')
        ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
        ->where('users.kelas', $this->kelas)
        ->select('first_name', 'kode_kelas', 'raport_mid_tks.id as id_raport', 'nis')
        ->paginate(10);


        $this->dataRaport = $data;

        foreach($this->dataRaport as $item){
            $item->nilai_bsb = RaportMidTkNilai::where('id_raport', $item->id_raport)
                                        ->where('bsb', 'true')->count();
            $item->nilai_bsh = RaportMidTkNilai::where('id_raport', $item->id_raport)
                                        ->where('bsh', 'true')->count();
            $item->nilai_mb = RaportMidTkNilai::where('id_raport', $item->id_raport)
                                        ->where('mb', 'true')->count();
            $item->nilai_bb = RaportMidTkNilai::where('id_raport', $item->id_raport)
                                        ->where('bb', 'true')->count();
            $item->countRow = RaportMidTkNilai::where('id_raport', $item->id_raport)->count();
        }
    }
}
