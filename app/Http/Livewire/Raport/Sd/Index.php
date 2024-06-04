<?php

namespace App\Http\Livewire\Raport\Sd;

use App\Models\Campu;
use App\Models\KompetensiDasar;
use App\Models\Mapel;
use App\Models\Predikat;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $loading = false;
    public $notif;
    public $ta;
    public $kelas;
    public $siswa;

    public $dataTa;
    public $dataKelas;
    public $dataCampus;
    public $dataNilai;
    public $dataPredikat;
    public $dataKd;
    public $dataMapel;

    public $detailSemester;
    public $detailKelas;
    public $tanggalRaport;
    public $dataTanggalraport;

    public function mount()
    {
        $this->getDataTa();
    }

    public function loadAll()
    {
        $this->getDataCampus();
        $this->getDataKelas();

        if($this->ta){
            $this->getDetailSemester();
            $this->getNilai();
            $this->getDataPredikat();
            $this->getDataKd();
            $this->getDataMapel(); 
        }

        if($this->kelas){
            $this->getDetailKelas();
            $this->getDataTanggal();
        }
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.sd.index');
    }

    public function getDataTa()
    {
        $data = Semester::all();
        $this->dataTa = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->orderBy('tingkat', 'ASC')->get();
        $this->dataKelas = $data;
    }

    public function getDetailKelas()
    {
        $data = Room::findOrFail($this->kelas);
        $this->detailKelas = $data;
    }

    public function getDataCampus()
    {
        $data = Campu::findOrFail(Auth::user()->campus_id);
        $this->dataCampus = $data;
    }

    public function getDetailSemester()
    {
        $data = Semester::findOrFail($this->ta);
        $this->detailSemester = $data;
    }

    public function getNilai()
    {
        $data = SdNilaiPelajaran::leftJoin('mapels', 'mapels.idmapel', '=', 'sd_nilai_pelajarans.mapel_id')
                            ->leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                            ->leftJoin('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                            ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                            ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                            ->where('users.kelas', $this->kelas)
                            ->select('users.id as iduser', 'first_name', 'nick_name', 'nilai', 'mapel_id', 'sd_nilai_pelajarans.id as idraport')
                            ->get();
        $this->dataNilai = $data;
    }

    public function getDataTanggal()
    {
        $data = SdNilaiPelajaran::leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                                ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                                ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                                ->where('users.kelas', $this->kelas)
                                ->select('tanggal_raport')
                                ->first();
        $this->dataTanggalraport = $data->tanggal_raport;
    }

    public function updateTanggalRaport()
    {
        $this->validate([
            'tanggalRaport'     => 'required|max:10|min:10',
        ]);
        SdNilaiPelajaran::leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                        ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                        ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                        ->where('users.kelas', $this->kelas)
                        ->update(['tanggal_raport' => $this->tanggalRaport]);
        $this->notif = [
            'status'    => 200,
            'message'   => 'Tanggal Diperbaharui!',
        ];
        $this->showAlert();
    }
 
    public function getDataPredikat()
    {
        $data = Predikat::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataPredikat = $data;
    }

    public function getDataKd()
    {
        $data = KompetensiDasar::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKd = $data;
    }

    public function getDataMapel()
    {
        $data = Mapel::where('mapel_campus', Auth::user()->campus_id)->get();
        $this->dataMapel = $data;
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}
