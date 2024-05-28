<?php

namespace App\Http\Livewire\Teacher\Kompetensi\Form;

use App\Http\Livewire\Teacher\KompetensiKhusus;
use App\Models\KompetensiTeacher;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = false;
    protected $listeners = ['editKompetensi' => 'listenerForEditKompetensi']; //mendengarkan event edit kompetensi

    public $userid;
    public $bidang_studi;
    public $urutan;

    protected $rules = [
        'bidang_studi'  => 'required|string|min:2',
        'urutan'        => 'required|numeric',
    ];

    public function listenerForEditKompetensi($id)
    {
        $this->userid = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $kompetensi = KompetensiTeacher::findOrFail($id);
        $this->bidang_studi = $kompetensi->bidang_studi;
        $this->urutan = $kompetensi->urutan;
    }

    public function render()
    {
        return view('livewire.teacher.kompetensi.form.edit');
    }

    public function updateKompetensiTeacher()
    {
        $this->isClicked = true;
        $validatedData = $this->validate(); //memanggil validasi data

        $kompetensi = KompetensiTeacher::findOrFail($this->userid);
        $kompetensi->update($validatedData);

        $this->resetForm(); //reset form input
        $this->closeModal(); //close modal input
        $this->emit('loadDataTable'); //memanggil even load data untuk mereload table
        session()->flash('message', 'Edit data berhasil!'); //kirim notifikasi update

    }

    public function resetForm()
    {
        $this->bidang_studi = null;
        $this->urutan = null;
    }

    public function closeModal()
    {
        $this->emit('closeModal'); //Menutup modal input
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
