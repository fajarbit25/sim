<?php

namespace App\Http\Livewire\Teacher\Pendidikan\Form;

use App\Models\PendidikanTeacher;
use Livewire\Component;

class Create extends Component
{
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

    public function render()
    {
        return view('livewire.teacher.pendidikan.form.create');
    }

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function storePendidikanTeacher()
    {
        $this->isClicked = true;

        // Menambahkan user_id ke dalam array validated data
        $validatedData = array_merge($this->validate(), [
            'user_id' => $this->userid,
        ]);

        PendidikanTeacher::create($validatedData);

        $this->closeModal();
        $this->resetForm();
        $this->emit('reloadDataTable');
        session()->flash('message', 'Data Pendidikan ditambahkan!');
    }

    public function create()
    {
        $this->emit('openModalCreate');
    }

    public function closeModal()
    {
        $this->emit('closeModalCreate');
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

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
