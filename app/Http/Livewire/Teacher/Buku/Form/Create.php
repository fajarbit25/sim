<?php

namespace App\Http\Livewire\Teacher\Buku\Form;

use App\Models\BukuTeacher;
use Livewire\Component;

class Create extends Component
{
    public $isClicked = false;

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

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function create()
    {
        $this->emit('createBuku');
    }

    public function render()
    {
        return view('livewire.teacher.buku.form.create');
    }

    public function storeBuku()
    {
        $this->isClicked = true;
        $this->validate();

        BukuTeacher::create([
            'user_id'       => $this->userid,
            'judul'         => $this->judul,
            'tahun'         => $this->tahun,
            'penerbit'      => $this->penerbit,
            'isbn'          => $this->isbn,
        ]);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data Buku Berhasil Ditambahkan!');
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
