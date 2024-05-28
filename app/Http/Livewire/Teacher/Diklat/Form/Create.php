<?php

namespace App\Http\Livewire\Teacher\Diklat\Form;

use App\Models\DiklatTeacher;
use Livewire\Component;

class Create extends Component
{
    public $isClicked = false;
    public $userid;

    public $jenis;
    public $nama;
    public $penyelenggara;
    public $tahun;
    public $peran;
    public $tingkat;
    public $berapa_jam;
    public $sertifikat_diklat;

    protected $rules = [
        'jenis'             => 'required',
        'nama'              => 'required',
        'penyelenggara'     => 'required',
        'tahun'             => 'required|min:4|max:4',
        'peran'             => 'required',
        'tingkat'           => 'required',
        'berapa_jam'        => 'required|numeric',
        'sertifikat_diklat' => 'required|unique:diklat_teachers',
    ];

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function create()
    {
        $this->emit('createDiklat');
    }

    public function storeDiklat()
    {
        $this->isClicked = true;
        $this->validate();

        DiklatTeacher::create([
            'user_id'           => $this->userid,
            'jenis'             => $this->jenis,
            'nama'              => $this->nama,
            'penyelenggara'     => $this->penyelenggara,
            'tahun'             => $this->tahun,
            'peran'             => $this->peran,
            'tingkat'           => $this->tingkat,
            'berapa_jam'        => $this->berapa_jam,
            'sertifikat_diklat' => $this->sertifikat_diklat,
        ]);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data berhasil ditambahkan');
    }

    public function resetForm()
    {
        $this->jenis = null;
        $this->nama = null;
        $this->penyelenggara = null;
        $this->tahun = null;
        $this->peran = null;
        $this->tingkat = null;
        $this->berapa_jam = null;
        $this->sertifikat_diklat = null;
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.teacher.diklat.form.create');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
