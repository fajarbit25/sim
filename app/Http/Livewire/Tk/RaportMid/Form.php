<?php

namespace App\Http\Livewire\Tk\RaportMid;
use Illuminate\Support\Facades\Hash;

use App\Models\RaportMidTKMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public $dataAgama;
    public $dataAll;
    public $dataSubKategori;
    public $dataMaster;
    public $dataMateri;

    public $aspek;
    public $subkategori;
    public $materi;
    public $tujuan;



    public function loadAll()
    {
        $this->getDataAgama();
        $this->getDataAll();
        $this->getDataMaster();
        //$this->getSubCategori();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.tk.raport-mid.form');
    }

    public function getDataAgama()
    {
        $data = RaportMidTKMaster::where('kategori', 'Agama')->get();
        $this->dataAgama = $data;
    }

    public function getDataAll()
    {
        $data = RaportMidTKMaster::where('kategori', '!=', 'Agama')->get();
        $this->dataAll = $data;
    }

    public function getDataMaster()
    {
        $data = RaportMidTKMaster::all();
        $this->dataMaster = $data;
    }

    public function createForm()
    {
        $this->emit('modalCreate');
    }

    public function getSubCategori()
    {
        $data = RaportMidTKMaster::where('kategori', $this->aspek)->select('subkategori')->get();
        $uniqueData = collect($data)->unique()->values()->all();
        $this->dataSubKategori = $uniqueData;
    }
    
    public function getDataMateri() 
    {
        $data = RaportMidTKMaster::where('subkategori', $this->subkategori)->select('materi')->get();
        $this->dataMateri = $data;
        $this->getSubCategori();
    }

}
