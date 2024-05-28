<?php

namespace App\Http\Livewire\Teacher\Beasiswa\Form;

use App\Models\BeasiswaTeacher;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = false;
    protected $listeners = ['editBeasiswa' => 'listenForEditBeasiswa'];
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

    public function listenForEditBeasiswa($id)
    {
        $this->userid = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $beasiswa = BeasiswaTeacher::findOrFail($id);

       $this->jenis = $beasiswa->jenis;
       $this->keterangan = $beasiswa->keterangan;
       $this->tahun_mulai = $beasiswa->tahun_mulai;
       $this->tahun_akhir = $beasiswa->tahun_akhir;
       $this->masih_menerima = $beasiswa->masih_menerima;
    }

    public function updateBeasiswa()
    {
        $this->isClicked = true;
        $validatedData = $this->validate();

        $beasiswa = BeasiswaTeacher::findOrFail($this->userid);
        $beasiswa->update($validatedData);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data berhasil diupdate!');
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

    public function render()
    {
        return view('livewire.teacher.beasiswa.form.edit');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
