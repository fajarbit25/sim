<?php

namespace App\Http\Livewire\Teacher\Pendidikan\Form;

use App\Models\PendidikanTeacher;
use Livewire\Component;

class Edit extends Component
{
    protected $listeners = ['editPendidikan' => 'listenFromeditPendidikan']; //Mendengarkan even edit pendidikan
    public $isClicked = false;

    public $userid;
    public $bidang_studi;
    public $jenjang;
    public $gelar_akademik;
    public $satuan_pendidikan_formal;
    public $tahun_masuk;
    public $tahun_lulus;
    public $nim;
    public $matkul;
    public $semester;
    public $ipk;

    protected $rules = [
        'bidang_studi'              => 'required',
        'jenjang'                   => 'required',
        'gelar_akademik'            => 'required',
        'satuan_pendidikan_formal'  => 'required',
        'tahun_masuk'               => 'required|min:4|max:4',
        'tahun_lulus'               => 'required|min:4|max:4',
        'nim'                       => 'required|numeric',
        'matkul'                    => 'required',
        'semester'                  => 'required',
        'ipk'                       => 'required|numeric',
    ];

    public function listenFromeditPendidikan($id)
    {
        $this->userid = $id;
        $this->loadData($id);
    }

    public function loadData($id)
    {
        $load = PendidikanTeacher::findOrfail($id);
        $this->bidang_studi = $load->bidang_studi;
        $this->jenjang = $load->jenjang;
        $this->gelar_akademik = $load->gelar_akademik;
        $this->satuan_pendidikan_formal = $load->satuan_pendidikan_formal;
        $this->tahun_masuk = $load->tahun_masuk;
        $this->tahun_lulus = $load->tahun_lulus;
        $this->nim = $load->nim;
        $this->matkul = $load->matkul;
        $this->semester = $load->semester;
        $this->ipk = $load->ipk;
    }

    public function updatePendidikanTeacher()
    {
        $validatedData = $this->validate();

        $pendidikan = PendidikanTeacher::findOrfail($this->userid);
        $pendidikan->update($validatedData);

        session()->flash('message', 'Data berhasil di-update'); // Kirim notifikasi
        $this->closeModal();
        $this->resetForm();
        $this->emit('reloadDataTable');
    }

    public function closeModal()
    {
        $this->emit('closeModalEdit');
    }

    public function resetForm()
    {
        $this->bidang_studi = null;
        $this->jenjang = null;
        $this->gelar_akademik = null;
        $this->satuan_pendidikan_formal = null;
        $this->tahun_masuk = null;
        $this->tahun_lulus = null;
        $this->nim = null;
        $this->matkul = null;
        $this->semester = null;
        $this->ipk = null;
    }

    public function render()
    {
        return view('livewire.teacher.pendidikan.form.edit');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
