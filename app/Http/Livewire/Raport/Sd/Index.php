<?php

namespace App\Http\Livewire\Raport\Sd;

use App\Models\Campu;
use App\Models\Mapel;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $loading = false;
    public $ta;
    public $kelas;
    public $siswa;

    public $dataTa;
    public $dataKelas;
    public $dataSiswa;
    public $dataCampus;
    public $nilaiPengetahuan;

    public $detailSiswa;
    public $detailSemester;

    public function mount()
    {
        $this->getDataTa();
        $this->getDataKelas();
        $this->getDataSiswa();
    }

    public function loadAll()
    {
        $this->getDataSiswa();
        $this->getDataCampus();
        $this->getDetailSiswa();
        if($this->ta){
            $this->getDetailSemester();
            $this->getNilaiPengetahuan();
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

    public function getDataSiswa()
    {
        $data = User::join('registers', 'registers.user_id', '=', 'users.id')
                        ->where('kelas', $this->kelas)
                        ->select('id', 'first_name', 'nis')->orderBy('first_name', 'ASC')->get();
        $this->dataSiswa = $data;
    }

    public function getDetailSiswa()
    {
        $data = User::join('registers', 'registers.user_id', '=', 'users.id')
                        ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                        ->where('id', $this->siswa)
                        ->select('id', 'first_name', 'nis', 'tingkat', 'kode_kelas')->first();
        $this->detailSiswa = $data;
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

    public function getNilaiPengetahuan()
    {
        $data = SdNilaiPelajaran::leftJoin('mapels', 'mapels.idmapel', '=', 'sd_nilai_pelajarans.mapel_id')
                            ->join('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                            ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                            ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                            ->where('user_id', $this->siswa)
                            ->where('sd_nilai_pelajarans.aspek', 'Pengetahuan')
                            ->get();
        $this->nilaiPengetahuan = $data;
    }
}
