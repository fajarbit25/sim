<?php

namespace App\Http\Livewire\Teacher;

use App\Models\SchoolTeacher;
use Livewire\Component;

class Sekolah extends Component
{
    public $isClicked = false;

    public $user_id;
    public $nama;
    public $npsn;
    public $alamat;

    //validasi input
    protected $rules = [
        'nama'  => 'required|min:3',
        'npsn'  => 'required|min:4',
        'alamat'=> 'required|min:3',
    ];

    public function updateSchoolTeacher()
    {
        $this->isClicked = true; //animasi button

        $validatedData = $this->validate(); //panggil validasi input

        SchoolTeacher::where('user_id', $this->user_id)->update([
            'nama_sekolah'      => $this->nama,
            'npsn_sekolah'      => $this->npsn,
            'alamat_sekolah'    => $this->alamat,
        ]);

        session()->flash('message', 'Data sekolah diperbaharui!.'); //kirim notifikasi success
    }

    public function mount($sekolah)
    {
        $this->user_id = $sekolah->user_id;
        $this->nama = $sekolah->nama_sekolah;
        $this->npsn = $sekolah->npsn_sekolah;
        $this->alamat = $sekolah->alamat_sekolah;
    }

    public function render()
    {
        return view('livewire.teacher.sekolah');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
