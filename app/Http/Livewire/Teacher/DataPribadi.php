<?php

namespace App\Http\Livewire\Teacher;

use App\Models\BiodataTeacher;
use Livewire\Component;

class DataPribadi extends Component
{
    public $isClicked = false;    
    
    public $user_id;
    public $kk;
    public $agama;
    public $npwp;
    public $nama_npwp;
    public $kewarganegaraan;
    public $negara;
    public $status_perkawinan;
    public $nama_pasangan;
    public $nip_pasangan;
    public $pekerjaan_pasangan;

    protected $rules = [
        'user_id'           => 'required',
        'kk'                => 'required|min:16',
        'agama'             => 'required',
        'npwp'              => 'required|min:16',
        'nama_npwp'         => 'required|min:3',
        'kewarganegaraan'   => 'required|min:3',
        'negara'            => 'required',
        'status_perkawinan' => 'required',
        'nama_pasangan'     => 'required|min:3',
    ];


    public function mount($biodata)
    {   
        $this->user_id          = $biodata->user_id;
        $this->kk               = $biodata->kk;
        $this->agama            = $biodata->agama;
        $this->npwp             = $biodata->npwp;
        $this->nama_npwp        = $biodata->nama_npwp;
        $this->kewarganegaraan  = $biodata->kewarganegaraan;
        $this->negara           = $biodata->negara;
        $this->status_perkawinan= $biodata->status_perkawinan;
        $this->nama_pasangan    = $biodata->nama_pasangan;
        $this->nip_pasangan     = $biodata->nip_pasangan;
        $this->pekerjaan_pasangan= $biodata->pekerjaan_pasangan;
    }

    public function render()
    {
        return view('livewire.teacher.data-pribadi');
    }

    public function updateBiodataGuru()
    {
        $this->isClicked = true; //Animasi button

        $validatedData = $this->validate();

        BiodataTeacher::where('user_id', $this->user_id)->update([
            'kk'                => $this->kk,
            'agama'             => $this->agama,
            'npwp'              => $this->npwp,
            'nama_npwp'         => $this->nama_npwp,
            'kewarganegaraan'   => $this->kewarganegaraan,
            'negara'            => $this->negara,
            'status_perkawinan' => $this->status_perkawinan,
            'nama_pasangan'     => $this->nama_pasangan,
            'nip_pasangan'      => $this->nip_pasangan,
            'pekerjaan_pasangan'=> $this->pekerjaan_pasangan,
        ]);

        session()->flash('message', 'Biodata tenaga pendidik diperbaharui!.'); //kirim notifikasi success
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
