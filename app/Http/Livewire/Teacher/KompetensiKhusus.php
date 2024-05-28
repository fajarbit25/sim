<?php

namespace App\Http\Livewire\Teacher;

use App\Models\KompetensiKhususTeacher;
use Livewire\Component;

class KompetensiKhusus extends Component
{
    public $isClicked = false;

    public $user_id;
    public $punya_lisensi_kepsek;
    public $nuks;
    public $keahlian_lab;
    public $menangani_keb_khusus;
    public $keahlian_braile;
    public $keahlian_bhs_isyarat;

    protected $rules = [
        'punya_lisensi_kepsek'      => 'required|min:2|max:5',
        'menangani_keb_khusus'      => 'required',
        'keahlian_braile'           => 'required|min:2|max:5',
        'keahlian_bhs_isyarat'      => 'required|min:2|max:5',
    ];

    public function updateKompetensiKhusus()
    {
        $this->isClicked = true; // btn animasi

        $this->validate(); //validasi input

        /**Store data */
        KompetensiKhususTeacher::where('user_id', $this->id)->update([
            'punya_lisensi_kepsek'      => $this->punya_lisensi_kepsek,
            'nuks'                      => $this->nuks,
            'keahlian_lab'              => $this->keahlian_lab,
            'menangani_keb_khusus'      => $this->menangani_keb_khusus,
            'keahlian_braile'           => $this->keahlian_braile,
            'keahlian_bhs_isyarat'      => $this->keahlian_bhs_isyarat,
        ]);

        session()->flash('message', 'Data Kompetensi diperbaharui!.'); //kirim notifikasi success
    }

    public function mount($kompetensi)
    {
        $this->user_id = $kompetensi->id;
        $this->punya_lisensi_kepsek = $kompetensi->punya_lisensi_kepsek;
        $this->nuks = $kompetensi->nuks;
        $this->keahlian_lab = $kompetensi->keahlian_lab;
        $this->menangani_keb_khusus = $kompetensi->menangani_keb_khusus;
        $this->keahlian_braile = $kompetensi->keahlian_braile;
        $this->keahlian_bhs_isyarat = $kompetensi->keahlian_bhs_isyarat;
    }

    public function render()
    {
        return view('livewire.teacher.kompetensi-khusus');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
