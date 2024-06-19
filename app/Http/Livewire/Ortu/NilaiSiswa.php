<?php

namespace App\Http\Livewire\Ortu;

use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NilaiSiswa extends Component
{
    public $loading = false;

    public $semester;
    public $dataSemester;
    public $detailSemester;
    public $dataNilai;

    public function loadAll()
    {
        $this->getDataSemester();
        if($this->semester != 0){
            $this->getDetailSemester();
            $this->getDataNilai();
        }
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.ortu.nilai-siswa');
    }

    public function getDataSemester()
    {
        $data = Semester::limit(10)->get();
        $this->dataSemester = $data;
    }

    public function getDetailSemester()
    {
        $data = Semester::findOrFail($this->semester);
        $this->detailSemester = $data;
    }

    public function getDataNilai()
    {
        $data =  SdNilaiPelajaran::leftJoin('mapels', 'mapels.idmapel', '=', 'sd_nilai_pelajarans.mapel_id')
                            ->leftJoin('kompetensi_dasars', 'kompetensi_dasars.id', '=', 'sd_nilai_pelajarans.kd')
                            ->where('sd_nilai_pelajarans.ta', $this->detailSemester->tahun_ajaran)
                            ->where('sd_nilai_pelajarans.semester', $this->detailSemester->semester_kode)
                            ->where('sd_nilai_pelajarans.aspek', 'Sumatif')
                            ->where('sd_nilai_pelajarans.user_id', Auth::user()->id)
                            ->select('nilai', 'mapel_id', 'mapels.kode_mapel', 'test', 'non_test', 'mapels.nama_mapel')
                            ->get();
        $this->dataNilai = $data;

    }

}
