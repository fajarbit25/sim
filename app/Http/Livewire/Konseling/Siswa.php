<?php

namespace App\Http\Livewire\Konseling;

use App\Models\Konseling;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class Siswa extends Component
{
    public $userid;
    public $ta;
    public $semester;
    public $dataKonseling;
    public $detailKonseling;
    public $idKonseling;
    public $guru;

    public function mount($id)
    {
        $this->userid = $id;
        $this->getDataSemester();
    }

    public function render()
    {
        $this->getDataKonseling();
        return view('livewire.konseling.siswa');
    }

    public function getDataSemester()
    {
        $data = Semester::where('is_active', 'true')->first();
        $this->ta = $data->tahun_ajaran;
        $this->semester = $data->semester_kode;
    }

    public function getDataKonseling()
    {
        $data = Konseling::join('konseling_points', 'konseling_points.id', '=', 'konselings.pelanggaran_id')
                            ->where('ta', $this->ta)->where('semester', $this->semester)
                            ->where('user_id', $this->userid)
                            ->select('konselings.id', 'ket', 'pelanggaran', 'point', 'konselings.created_at as tanggal')->get();
        $this->dataKonseling = $data;
    }

    public function mainModal($id)
    {
       $this->idKonseling = $id;
       $this->getDetailKonseling();
       $this->emit('mainModal');
    }

    public function getDetailKonseling()
    {
        $data = Konseling::join('konseling_points', 'konseling_points.id', '=', 'konselings.pelanggaran_id')
                            ->where('konselings.id', $this->idKonseling)
                            ->select('konselings.id', 'ket', 'pelanggaran', 'point', 'konselings.created_at as tanggal', 'foto', 'created_by')->first();
        $this->detailKonseling = $data;

        $dataGuruKonseling = User::findOrFail($data->created_by);
        $this->guru = $dataGuruKonseling->first_name;
    }
}
