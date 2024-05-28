<?php

namespace App\Http\Livewire\Teacher\Anak\Form;

use App\Models\AnakTeacher;
use Livewire\Component;

class Create extends Component
{
    public $isClicked;

    public $userid;
    public $nama;
    public $status;
    public $jenjang_pendidikan;
    public $nisn;
    public $gender;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $tahun_masuk;

    protected $rules = [
        'nama'                  => 'required',
        'status'                => 'required',
        'gender'                => 'required',
        'tempat_lahir'          => 'required',
        'tanggal_lahir'         => 'required|min:10|max:10',
    ];

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function create()
    {
        $this->emit('createAnak');
    }

    public function createAnak()
    {
        $this->isClicked = true;
        $this->validate();

        AnakTeacher::create([
            'user_id'               => $this->userid,
            'nama'                  => $this->nama,
            'status'                => $this->status,
            'jenjang_pendidikan'    => $this->jenjang_pendidikan,
            'nisn'                  => $this->nisn,
            'gender'                => $this->gender,
            'tempat_lahir'          => $this->tempat_lahir,
            'tanggal_lahir'         => $this->tanggal_lahir,
            'tahun_masuk'           => $this->tahun_masuk,
        ]);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data anak berhasil ditambahkan!');
    }

    public function render()
    {
        return view('livewire.teacher.anak.form.create');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function resetForm()
    {
        $this->nama = null;
        $this->status = null;
        $this->jenjang_pendidikan = null;
        $this->nisn = null;
        $this->gender = null;
        $this->tempat_lahir = null;
        $this->tanggal_lahir = null;
        $this->tahun_masuk = null;   
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
