<?php

namespace App\Http\Livewire\Teacher\Anak\Form;

use App\Models\AnakTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked = false;
    protected $listeners = ['deleteAnak' => 'listenForDeleteAnak'];

    public $idAnak;

    public function render()
    {
        return view('livewire.teacher.anak.form.delete');
    }

    public function listenForDeleteAnak($id)
    {
        $this->idAnak = $id;
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
        $this->delete();
    }

    public function delete()
    {
        $anak = AnakTeacher::findOrFail($this->idAnak);
        $anak->delete();

        $this->emit('closeModal');
        $this->emit('loadDataTable');
        session()->flash('message', 'Data dihapus!');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }
}
