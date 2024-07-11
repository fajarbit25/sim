<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\TahfidzSurah;
use Livewire\Component;
use Livewire\WithPagination;

class TahfidzDatabase extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading = false;
    public $notif;

    public $idEdit = 0;
    public $idDelete;
    public $kode;
    public $juz = '30';
    public $ayat;
    public $bahasa;
    public $arabic;


    public function render()
    {
        return view('livewire.raport.km.tahfidz-database', [
            'data'      => TahfidzSurah::orderBy('id', 'DESC')->paginate(10),
        ]);
    }

    public function modalAdd()
    {
        $this->emit('modalAdd');
    }


    public function create()
    {
        $this->validate([
            'kode'      => 'required|unique:tahfidz_surahs',
            'juz'       => 'required',
            'ayat'      => 'required',
            'bahasa'    => 'required',
            'arabic'    => 'required'
        ]);

        TahfidzSurah::create([
            'kode'      => $this->kode,
            'bahasa'    => $this->bahasa,
            'arab'      => $this->arabic,
            'jus'       => $this->juz,
            'ayat'      => $this->ayat,
        ]);

        $this->notif = [
            'status'    => 200,
            'message'   => 'Surah "'.$this->bahasa.' / '.$this->arabic.'" Ditambahkan!',
        ];
        $this->emit('closeModal');
        $this->showAlert();
        $this->resetForm();
    }

    public function modalEdit($id)
    {
        $data = TahfidzSurah::findOrFail($id);
        $this->idEdit = $id;
        $this->kode = $data->kode;
        $this->ayat = $data->ayat;
        $this->bahasa = $data->bahasa;
        $this->arabic = $data->arab;

        $this->emit('modalAdd');
    }

    public function update()
    {
        $data = TahfidzSurah::findOrFail($this->idEdit);
        $data->update([
            'kode'      => $this->kode,
            'bahasa'    => $this->bahasa,
            'arab'      => $this->arabic,
            'jus'       => $this->juz,
            'ayat'      => $this->ayat,
        ]);

        $this->notif = [
            'status'    => 200,
            'message'   => 'Surah "'.$this->bahasa.' / '.$this->arabic.'" Diperbaharui!',
        ];
        $this->emit('closeModal');
        $this->showAlert();
        $this->resetForm();
    }

    public function modalDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function delete()
    {
        $data = TahfidzSurah::findOrFail($this->idDelete);
        $data->delete();
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data dihapus!',
        ];
        $this->emit('closeModal');
        $this->showAlert();
        $this->idDelete = "";
    }

    public function resetForm()
    {
        $this->idEdit = 0;
        $this->kode = "";
        $this->ayat = "";
        $this->bahasa = "";
        $this->arabic = "";
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}
