<?php

namespace App\Http\Livewire\Teacher\Sertifikasi\Form;

use App\Models\SertifikasiTeacher;
use Livewire\Component;

class Edit extends Component
{
    public $isClicked = true; //animasi
    public $sertifikasi_id; // Property untuk menyimpan ID dari data yang akan di-edit
    public $jenis;
    public $nomor;
    public $tahun;
    public $bidang_studi;
    public $nrg;
    public $nomor_peserta;

    protected $listeners = ['editSertifikasi' => 'listenForEditSertifikasi'];

    protected $rules = [
        'jenis'         => 'required',
        'nomor'         => 'required',
        'tahun'         => 'required',
        'bidang_studi'  => 'required',
        'nrg'           => 'required',
        'nomor_peserta' => 'required',
    ];

    public function listenForEditSertifikasi($id)
    {
        $this->sertifikasi_id = $id;
        $this->loadData();
    }

    public function loadData()
    {
        $sertifikasi = SertifikasiTeacher::findOrFail($this->sertifikasi_id);
        $this->jenis = $sertifikasi->jenis;
        $this->nomor = $sertifikasi->nomor;
        $this->tahun = $sertifikasi->tahun;
        $this->bidang_studi = $sertifikasi->bidang_studi;
        $this->nrg = $sertifikasi->nrg;
        $this->nomor_peserta = $sertifikasi->nomor_peserta;

    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.teacher.sertifikasi.form.edit')
        ->with('sertifikasi_id', $this->sertifikasi_id)
        ->with('jenis', $this->jenis)
        ->with('nomor', $this->nomor)
        ->with('tahun', $this->tahun)
        ->with('bidang_studi', $this->bidang_studi)
        ->with('nrg', $this->nrg)
        ->with('nomor_peserta', $this->nomor_peserta);
    }

    public function edit($id)
    {
        $sertifikasi = SertifikasiTeacher::findOrFail($id); // Cari data berdasarkan ID

        $this->sertifikasi_id = $sertifikasi->id;
        $this->jenis = $sertifikasi->jenis;
        $this->nomor = $sertifikasi->nomor;
        $this->tahun = $sertifikasi->tahun; 
        $this->bidang_studi = $sertifikasi->bidang_studi;
        $this->nrg = $sertifikasi->nrg;
        $this->nomor_peserta = $sertifikasi->nomor_peserta;

        $this->isClicked = true; // Tampilkan form edit
    }

    public function update()
    {
        $this->validate(); // Validasi data

        $sertifikasi = SertifikasiTeacher::findOrFail($this->sertifikasi_id); // Cari data berdasarkan ID
        $sertifikasi->update([
            'jenis'         => $this->jenis,
            'nomor'         => $this->nomor,
            'tahun'         => $this->tahun,
            'bidang_studi'  => $this->bidang_studi,
            'nrg'           => $this->nrg,
            'nomor_peserta' => $this->nomor_peserta,
        ]);

        session()->flash('message', 'Data berhasil di-update'); // Kirim notifikasi
        $this->closeModal();
        $this->resetForm();
        $this->emit('reloadDataTable');
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

    public function closeModal()
    {
        $this->emit('closeModal'); // Emit event untuk menutup modal
    }
    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked; // Aminasi pada button
    }
}

