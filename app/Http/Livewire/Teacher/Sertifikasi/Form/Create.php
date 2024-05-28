<?php

namespace App\Http\Livewire\Teacher\Sertifikasi\Form;

use App\Models\SertifikasiTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    public $isClicked = false;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user_id;
    
    public $jenis;
    public $nomor;
    public $tahun;
    public $bidang_studi;
    public $nrg;
    public $nomor_peserta;

    protected $rules = [
        'jenis'         => 'required',
        'nomor'         => 'required',
        'tahun'         => 'required',
        'bidang_studi'  => 'required',
        'nrg'           => 'required',
        'nomor_peserta' => 'required',
    ];


    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $result = SertifikasiTeacher::where('user_id', $this->user_id)->paginate(5);

        return view('livewire.teacher.sertifikasi.form.create');
        return view('livewire.teacher.sertifikasi', ['result' => $result]);
    }

    public function create()
    {
        $this->emit('openModal'); // Emit event untuk membuka modal
        $this->resetForm();
    }

    public function store()
    {
        $this->isClicked = true;

        $this->validate();//panggil validasi data

        SertifikasiTeacher::create([
            'user_id'       => $this->user_id,
            'jenis'         => $this->jenis,
            'nomor'         => $this->nomor,
            'tahun'         => $this->tahun,
            'bidang_studi'  => $this->bidang_studi,
            'nrg'           => $this->nrg,
            'nomor_peserta' => $this->nomor_peserta,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan'); //kirim notifikasi

        $this->closeModal();
        $this->resetForm();
        $this->emit('reloadDataTable');
    }

    public function closeModal()
    {
        $this->emit('closeModal'); // Emit event untuk menutup modal
    }



    public function resetForm()
    {
        $this->jenis = null;
        $this->nomor = null;
        $this->tahun = null;
        $this->bidang_studi = null;
        $this->nrg = null;
        $this->nomor_peserta = null;
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
