<?php

namespace App\Http\Livewire\Teacher\Buku\Form;

use App\Models\BukuTeacher;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = false;
    protected $listeners = ['editBuku' => 'listenFormEditBuku'];
    public $userid;

    public $judul;
    public $tahun;
    public $penerbit;
    public $isbn;

    protected $rules = [
        'judul'         => 'required',
        'tahun'         => 'required|min:4|max:4',
        'penerbit'      => 'required',
        'isbn'          => 'required',
    ];

    public function listenFormEditBuku($id)
    {
        $this->userid = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $buku = BukuTeacher::findOrFail($id);

        $this->judul = $buku->judul;
        $this->tahun = $buku->tahun;
        $this->penerbit = $buku->penerbit;
        $this->isbn = $buku->isbn;
    }

    public function render()
    {
        return view('livewire.teacher.buku.form.edit');
    }

    public function updateBuku()
    {
        $this->isClicked = true;
        $validatedData = $this->validate();

        $buku = BukuTeacher::findOrFail($this->userid);
        $buku->update($validatedData);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data berhasil diupdate!');

    }

    public function resetForm()
    {
        $this->judul = null;
        $this->tahun = null;
        $this->penerbit = null;
        $this->isbn = null;
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
