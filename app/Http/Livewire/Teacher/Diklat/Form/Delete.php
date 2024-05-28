<?php

namespace App\Http\Livewire\Teacher\Diklat\Form;

use App\Models\DiklatTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked = false;
    protected $listeners = ['deleteDiklat' => 'listenForDeleteDiklat'];

    public $userid;

    public function listenForDeleteDiklat($id)
    {
        $this->userid = $id;
    }

    public function render()
    {
        return view('livewire.teacher.diklat.form.delete');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
        $this->delete();
    }

    public function delete()
    {
        $diklat = DiklatTeacher::findOrFail($this->userid);
        $diklat->delete();

        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data dihapus!');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

}
