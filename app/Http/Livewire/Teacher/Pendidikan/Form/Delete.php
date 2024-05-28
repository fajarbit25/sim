<?php

namespace App\Http\Livewire\Teacher\Pendidikan\Form;

use App\Models\PendidikanTeacher;
use Livewire\Component;

class Delete extends Component
{
    protected $listeners = ['deletePendidikan' => 'listenerForDeletePendidikan']; //Menerima event deletePendidikan

    public $isClicked = false;
    public $userid;

    public function listenerForDeletePendidikan($id)
    {
        $this->userid = $id;
    }

    public function render()
    {
        return view('livewire.teacher.pendidikan.form.delete');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
        $this->delete();
    }

    public function delete()
    {
        $pendidikan = PendidikanTeacher::findOrFail($this->userid);
        $pendidikan->delete();
        
        $this->closeModal();//tutup modal
        $this->emit('reloadDataTable');//load Tabel pendidikan
        session()->flash('message', 'Data dihapus!');//Kirim notifikasi
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

}
