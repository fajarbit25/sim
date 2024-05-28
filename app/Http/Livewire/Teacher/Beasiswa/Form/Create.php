<?php

namespace App\Http\Livewire\Teacher\Beasiswa\Form;

use App\Models\BeasiswaTeacher;
use Livewire\Component;

class Create extends Component
{
    public $isClicked = false;

    public $userid;
    public $jenis;
    public $keterangan;
    public $tahun_mulai;
    public $tahun_akhir;
    public $masih_menerima;

    protected $rules = [
        'jenis'             => 'required',
        'keterangan'        => 'required',
        'tahun_mulai'       => 'required|min:4|max:4',
        'tahun_akhir'       => 'required|min:4|max:4',
        'masih_menerima'    => 'required',
    ];

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function create()
    {
        $this->emit('createBeasiswa');
    }

    public function render()
    {
        return view('livewire.teacher.beasiswa.form.create');
    }

    public function storeBeasiswa()
    {
        $this->isClicked = true;
        $this->validate();

        BeasiswaTeacher::create([
            'user_id'           => $this->userid,
            'jenis'             => $this->jenis,
            'keterangan'        => $this->keterangan,
            'tahun_mulai'       => $this->tahun_mulai,
            'tahun_akhir'       => $this->tahun_akhir,
            'masih_menerima'    => $this->masih_menerima,
        ]);

        $this->closeModal();
        $this->resetForm();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data Berhasil Ditambahkan!');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function resetForm()
    {
        $this->jenis = null;
        $this->keterangan = null;
        $this->tahun_mulai = null;
        $this->tahun_akhir = null;
        $this->masih_menerima = null;
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
