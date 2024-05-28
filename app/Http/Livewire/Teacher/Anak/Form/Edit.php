<?php

namespace App\Http\Livewire\Teacher\Anak\Form;

use App\Models\AnakTeacher;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = false;
    protected $listeners = ['editAnak' => 'listenForEditAnak'];

    public $idAnak;
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

    public function listenForEditAnak($id)
    {
        $this->idAnak = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $anak = AnakTeacher::findOrFail($id);
        $this->nama = $anak->nama;
        $this->status = $anak->status;
        $this->jenjang_pendidikan = $anak->jenjang_pendidikan;
        $this->nisn = $anak->nisn;
        $this->gender = $anak->gender;
        $this->tempat_lahir = $anak->tempat_lahir;
        $this->tanggal_lahir = $anak->tanggal_lahir;
        $this->tahun_masuk = $anak->tahun_masuk;
    }

    public function updateAnak()
    {
        $this->isClicked = true;
        $validatedData = $this->validate();

        $anak = AnakTeacher::findOrFail($this->idAnak);
        $anak->update([
            'nama'                  => $this->nama,
            'status'                => $this->status,
            'jenjang_pendidikan'    => $this->jenjang_pendidikan,
            'nisn'                  => $this->nisn,
            'gender'                => $this->gender,
            'tempat_lahir'          => $this->tempat_lahir,
            'tanggal_lahir'         => $this->tanggal_lahir,
            'tahun_masuk'           => $this->tahun_masuk,
        ]);

        $this->closeModal();
        $this->resetForm();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data berhasil diedit!');
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

    public function render()
    {
        return view('livewire.teacher.anak.form.edit');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
