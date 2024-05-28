<?php

namespace App\Http\Livewire\Teacher\Kompetensi\Form;

use App\Models\KompetensiTeacher;
use Livewire\Component;

class Create extends Component
{
    public $isClicked = false;

    public $userid;

    public $bidang_studi;
    public $urutan;

    protected $rules = [
        'bidang_studi'    => 'required|min:2',
        'urutan'          => 'required|numeric',
    ];

    public function mount($userid)
    {
        $this->userid = $userid; //menginisiasi fungsi userid
    }

    public function render()
    {
        return view('livewire.teacher.kompetensi.form.create');
    }

    public function create()
    {
        $this->emit('createKompetensi'); //membuat even create kompetensi untuk di kirim ke komponen create
    }

    public function createKompetensiTeacher()
    {
        $this->isClicked = true;
        $this->validate(); // memanggil validasi data

        KompetensiTeacher::create([
            'user_id'           => $this->userid,
            'bidang_studi'      => $this->bidang_studi,
            'urutan'            => $this->urutan,
        ]);

        $this->closeModal(); //menutup modal
        $this->resetForm(); // reset form
        $this->emit('loadDataTable'); // reload table data
        session()->flash('message', 'Data berhasil ditambahkan!'); //mengirim notifikasi ke FE
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function resetForm()
    {
        $this->bidang_studi = null;
        $this->urutan = null;
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
