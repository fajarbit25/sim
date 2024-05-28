<?php

namespace App\Http\Livewire\Teacher\Buku\Form;

use App\Models\BukuTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked = false;
    protected $listeners = ['deleteBuku' => 'listenForDeleteBuku'];

    public $userid;

    public function listenForDeleteBuku($id)
    {
        $this->userid = $id;
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
        $this->delete();
    }

    public function delete()
    {
        $this->isClicked = true;

        $buku = BukuTeacher::findOrFail($this->userid);
        $buku->delete();

        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data dihapus!');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.teacher.buku.form.delete');
    }
}
