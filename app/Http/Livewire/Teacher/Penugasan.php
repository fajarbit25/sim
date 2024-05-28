<?php

namespace App\Http\Livewire\Teacher;

use App\Models\PenugasanTeacher;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Penugasan extends Component
{
    public $isClicked = false;

    public $user_id;
    public $nomor_surat_tugas;
    public $tanggal_surat_tugas;
    public $tmt_tugas;
    public $sekolah_induk;
    public $keluar_karena;
    public $tanggal_keluar;
    public $uname_akun_ptk;
    public $pass_akun_ptk;

    protected function rules()
    {
        return [
            'nomor_surat_tugas'     => ['required', 'min:6', Rule::unique('penugasan_teachers')->ignore($this->user_id, 'user_id')],
            'tanggal_surat_tugas'   => ['required', 'min:10'],
            'tmt_tugas'             => ['required', Rule::unique('penugasan_teachers')->ignore($this->user_id, 'user_id')],
            'sekolah_induk'         => ['required'],
        ];
    }

    public function updatePenugasanTeacher()
    {
        $this->isClicked = true; //animasi button

        $this->validate(); //panggil validasi

        PenugasanTeacher::where('user_id', $this->user_id)->update([
            'nomor_surat_tugas'     => $this->nomor_surat_tugas,
            'tanggal_surat_tugas'   => $this->tanggal_surat_tugas,
            'tmt_tugas'             => $this->tmt_tugas,
            'sekolah_induk'         => $this->sekolah_induk,
            'keluar_karena'         => $this->keluar_karena,
            'tanggal_keluar'        => $this->tanggal_keluar,
            'uname_akun_ptk'        => $this->uname_akun_ptk,
            'pass_akun_ptk'         => $this->pass_akun_ptk,
        ]);

        session()->flash('message', 'Data penugasan di update'); //kirim notifikasi berhasil
    }

    public function mount($penugasan)
    {
        $this->user_id               = $penugasan->user_id;
        $this->nomor_surat_tugas     = $penugasan->nomor_surat_tugas;
        $this->tanggal_surat_tugas   = $penugasan->tanggal_surat_tugas;
        $this->tmt_tugas             = $penugasan->tmt_tugas;
        $this->sekolah_induk         = $penugasan->sekolah_induk;
        $this->keluar_karena         = $penugasan->keluar_karena;
        $this->tanggal_keluar        = $penugasan->tanggal_keluar;
        $this->uname_akun_ptk        = $penugasan->uname_akun_ptk;
        $this->pass_akun_ptk         = $penugasan->pass_akun_ptk;
    }

    public function render()
    {
        return view('livewire.teacher.penugasan');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
