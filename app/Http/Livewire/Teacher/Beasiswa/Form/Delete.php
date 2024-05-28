<?php

namespace App\Http\Livewire\Teacher\Beasiswa\Form;

use App\Models\BeasiswaTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked = false;
    protected $listeners = ['deleteBeasiswa' => 'listenFormDeleteBeasiswa'];
    public $userid;

    public function listenFormDeleteBeasiswa($id)
    {
        $this->userid = $id;
    }

    public function render()
    {
        return view('livewire.teacher.beasiswa.form.delete');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
        $this->delete();
    }

    public function delete()
    {
        $this->isClicked = true;

        $beasiswa = BeasiswaTeacher::findOrFail($this->userid);
        $beasiswa->delete();

        $this->closeModal();
        $this->emit('loadDataTable');
        session()->flash('message', 'Data dihapus!');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }
}
