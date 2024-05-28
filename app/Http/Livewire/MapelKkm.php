<?php

namespace App\Http\Livewire;

use App\Models\Predikat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MapelKkm extends Component
{
    public $loading = false;
    public $notif = [];

    public $min;
    public $max;
    public $min_nilai;
    public $max_nilai;
    public $deskripsi;
    public $predikat;
    public $idDelete;

    public $dataCapaian;
    public $dataPredikat;

    public function mount()
    {
        $this->getDataCapaian();
        $this->getDataPredikat();
    }

    public function loadAll()
    {
        $this->getDataCapaian();
        $this->getDataPredikat();
    }
    public function render()
    {
        return view('livewire.mapel-kkm');
    }

    public function getDataCapaian()
    {
        $data = Predikat::where('campus_id', Auth::user()->campus_id)
                        ->where('jenis', 'Capaian')->orderBy('nilai_max', 'DESC')->get();
        $this->dataCapaian = $data;
    }

    public function getDataPredikat()
    {
        $data = Predikat::where('campus_id', Auth::user()->campus_id)
                        ->where('jenis', 'Predikat')->orderBy('nilai_max', 'DESC')->get();
        $this->dataPredikat = $data;
    }

    public function modalPredikat()
    {
        $this->emit('modalPredikat');
    }
    public function closeModalPredikat()
    {
        $this->emit('closeModalPredikat');
    }

    public function modalPredikatNilai()
    {
        $this->emit('modalPredikatNilai');
    }

    public function closeModalNilai()
    {
        $this->emit('closeModalNilai');
    }

    public function resetForm()
    {
        $this->min = "";
        $this->max = "";
        $this->min_nilai = "";
        $this->max_nilai = "";
        $this->deskripsi = "";
        $this->predikat = "";
    }

    public function savePredikatCapaian()
    {
        $this->validate([
            'min'       => 'required',
            'max'       => 'required',
            'deskripsi' => 'required',
        ]);

        $data = [
            'jenis'         => 'Capaian',
            'nilai_min'     => $this->min,
            'nilai_max'     => $this->max,
            'deskripsi'     => $this->deskripsi,
            'campus_id'     => Auth::user()->campus_id,
        ];

        Predikat::create($data);

        $this->notif = [
            'status'    => 200,
            'message'   => 'Predikat Capaian Kompetensi Ditambahkan!',
        ];
        $this->showAlert();
        $this->loadAll();
        $this->resetForm();
        $this->closeModalPredikat();
    }

    public function savePredikatNilai()
    {
        $this->validate([
            'max_nilai'     => 'required',
            'min_nilai'     => 'required',
            'predikat'      => 'required',
        ]);

        $data = [
            'jenis'         => 'Predikat',
            'nilai_min'     => $this->min_nilai,
            'nilai_max'     => $this->max_nilai,
            'deskripsi'     => $this->predikat,
            'campus_id'     => Auth::user()->campus_id,
        ];

        Predikat::create($data);

        $this->notif = [
            'status'    => 200,
            'message'   => 'Predikat Nilai Ditambahkan!',
        ];

        $this->showAlert();
        $this->loadAll();
        $this->resetForm();
        $this->closeModalNilai();
    }

    public function confirmDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function delete()
    {
        $data = Predikat::findOrFail($this->idDelete);
        $data->delete();
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data Dihapus!',
        ];
        $this->showAlert();
        $this->closeModalDelete();
        $this->loadAll();
    }

    public function closeModalDelete()
    {
        $this->idDelete = 0;
        $this->emit('closeModalDelete');
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
