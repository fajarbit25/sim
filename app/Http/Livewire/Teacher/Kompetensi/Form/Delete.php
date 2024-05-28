<?php

namespace App\Http\Livewire\Teacher\Kompetensi\Form;

use App\Models\KompetensiTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked = false;
    protected $listeners = ['deleteKompetensi' => 'listenForDeleteKompetensi']; //Menerima even delete kompetensi

    public $userid;

    public function render()
    {
        return view('livewire.teacher.kompetensi.form.delete');
    }

    public function listenForDeleteKompetensi($id)
    {
        $this->userid = $id; // mendefinisikan variable ID
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked; //animasi button
        $this->delete(); //menjalankan perintah delete;
    }

    public function delete()
    {
        /**Menghapus */
        // KompetensiTeacher::destroy($this->userid);
        $kompetensi = KompetensiTeacher::findOrfail($this->userid);
        $kompetensi->delete();

        $this->closeModal(); //memanggil fungsi closemodal
        $this->emit('loadDataTable');//mendefinikasi even dataTable untuk mereload table;
        session()->flash('message', 'Data dihapus!'); // mengirim notifikasi ke FE
    }

    public function closeModal()
    {
        $this->emit('closeModal'); //menutup modal konfirmasi
    }
}
