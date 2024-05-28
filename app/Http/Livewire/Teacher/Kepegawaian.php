<?php

namespace App\Http\Livewire\Teacher;

use App\Models\KepegawaianTeacher;
use Livewire\Component;

class Kepegawaian extends Component
{
    public $isClicked = false;

    public $user_id;
    public $status;
    public $nip;
    public $niy;
    public $nuptk;
    public $jenis_ptk;
    public $sk_pengangkatan;
    public $tmt_pengangkatan;
    public $lembaga_pengankat;
    public $sk_cpns;
    public $tmt_pns;
    public $golongan;
    public $sumber_gaji;
    public $kartu_pegawai;
    public $karis_karsu;

    //Validate
    protected $rules = [
        'status'            => 'required',
        'jenis_ptk'         => 'required',
        'sk_pengangkatan'   => 'required',
        'tmt_pengangkatan'  => 'required',
        'lembaga_pengankat' => 'required', // Perbaikan penulisan disini
        'sumber_gaji'       => 'required',
    ];
    

    public function UpdateKepegawaianTeacher()
    {
        $this->isClicked = true; //Animasi button

        $this->validate($this->rules); //panggil validasi data

        KepegawaianTeacher::where('user_id', $this->user_id)->update([
            'status'            => $this->status,
            'nip'               => $this->nip,
            'niy'               => $this->niy,
            'nuptk'             => $this->nuptk,
            'jenis_ptk'         => $this->jenis_ptk,
            'sk_pengangkatan'   => $this->sk_pengangkatan,
            'tmt_pengangkatan'  => $this->tmt_pengangkatan,
            'lembaga_pengankat'=> $this->lembaga_pengankat,
            'sk_cpns'           => $this->sk_cpns,
            'tmt_pns'           => $this->tmt_pns,
            'golongan'          => $this->golongan,
            'sumber_gaji'       => $this->sumber_gaji,
            'kartu_pegawai'     => $this->kartu_pegawai,
            'karis_karsu'       => $this->karis_karsu,
        ]);

        session()->flash('message', 'Data kepegawaian diperbaharui!.'); //kirim notifikasi success
    }

    public function mount($kepegawaian)
    {
        $this->user_id = $kepegawaian->user_id;
        $this->status = $kepegawaian->status;
        $this->nip  = $kepegawaian->nip;
        $this->niy = $kepegawaian->niy;
        $this->nuptk = $kepegawaian->nuptk;
        $this->jenis_ptk = $kepegawaian->jenis_ptk;
        $this->sk_pengangkatan = $kepegawaian->sk_pengangkatan;
        $this->tmt_pengangkatan = $kepegawaian->tmt_pengangkatan;
        $this->lembaga_pengankat = $kepegawaian->lembaga_pengankat;
        $this->sk_cpns = $kepegawaian->sk_cpns;
        $this->tmt_pns = $kepegawaian->tmt_pns;
        $this->golongan = $kepegawaian->golongan;
        $this->sumber_gaji = $kepegawaian->sumber_gaji;
        $this->kartu_pegawai = $kepegawaian->kartu_pegawai;
        $this->karis_karsu = $kepegawaian->karis_karsu;
    }

    public function render()
    {
        return view('livewire.teacher.kepegawaian');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
