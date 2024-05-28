<?php

namespace App\Http\Livewire\Teacher\Diklat\Form;

use App\Models\DiklatTeacher;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = false;
    protected $listeners = ['editDiklat' => 'listenForEditDiklat'];
    public $userid;

    public $jenis;
    public $nama;
    public $penyelenggara;
    public $tahun;
    public $peran;
    public $tingkat;
    public $berapa_jam;
    public $sertifikat_diklat;



    protected function rules()
    {
        return [
            'jenis'             => ['required'],
            'nama'              => ['required'],
            'penyelenggara'     => ['required'],
            'tahun'             => ['required', 'min:4', 'max:4'],
            'peran'             => ['required'],
            'tingkat'           => ['required'],
            'berapa_jam'        => ['required', 'numeric'],
            'sertifikat_diklat' => ['required', Rule::unique('diklat_teachers')->ignore($this->userid)],
        ];
    }

    public function listenForEditDiklat($id)
    {
        $this->userid = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $diklat = DiklatTeacher::findOrFail($id);

        $this->jenis = $diklat->jenis;
        $this->nama = $diklat->nama;
        $this->penyelenggara = $diklat->penyelenggara;
        $this->tahun = $diklat->tahun;
        $this->peran = $diklat->peran;
        $this->tingkat = $diklat->tingkat;
        $this->berapa_jam = $diklat->berapa_jam;
        $this->sertifikat_diklat = $diklat->sertifikat_diklat;
    }

    public function updateDiklat()
    {
        $this->isClicked = true;
        $validatedData = $this->validate();

        $diklat = DiklatTeacher::findOrFail($this->userid);
        $diklat->update($validatedData);

        $this->resetForm();
        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data berhasil diupdate!');
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
        return view('livewire.teacher.diklat.form.edit');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
