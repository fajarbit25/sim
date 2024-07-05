<?php

namespace App\Http\Livewire\Tk\Rppmdiniyah;

use App\Models\RppmdiniyahMaster;
use App\Models\RppmdiniyahMateri;
use Livewire\Component;

class Master extends Component
{
    public $loading = false;
    public $dataMateri;
    public $dataKegiatan;
    public $materi;
    public $isActive = 0;

    public $inputMateri;
    public $inputKegiatan;

    public function mount()
    {
        $this->getDataMateri();
    }

    public function render()
    {
        return view('livewire.tk.rppmdiniyah.master');
    }

    public function getDataMateri()
    {
        $data = RppmdiniyahMateri::orderBy('id', 'ASC')->get();
        $this->dataMateri = $data;
    }

    public function selectedMateri($id)
    {
        $data = RppmdiniyahMateri::findOrFail($id);
        $this->isActive = $id ?? 0;
        $this->materi = $data->materi ?? "";
        $this->getDataKegiatan();
    }

    public function getDataKegiatan()
    {
        $data = RppmdiniyahMaster::where('materi', $this->materi)->get();
        $this->dataKegiatan = $data;
    }

    public function modalMateri()
    {
        $this->emit('modalMateri');
    }

    public function modalKegiatan()
    {
        $this->emit('modalKegiatan');
    }

    public function saveMateri()
    {
        $this->validate([
            'inputMateri'       => 'required',
        ]);
        $materi = RppmdiniyahMateri::create([
            'materi'    => $this->inputMateri,
        ]);
        $this->inputMateri = "";
        $this->emit('closeModal');
        $this->getDataMateri();
        $this->getDataKegiatan();
        $this->isActive = $materi->id;
    }

    public function saveKegiatan()
    {
        $this->validate([
            'inputKegiatan'             => 'required',
        ]);
        RppmdiniyahMaster::create([
            'materi'        => $this->materi,
            'kegiatan'      => $this->inputKegiatan,
        ]);
        $this->emit('closeModal');
        $this->getDataMateri();
        $this->getDataKegiatan();

    }

}
