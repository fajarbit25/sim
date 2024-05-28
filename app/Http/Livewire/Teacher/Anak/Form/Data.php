<?php

namespace App\Http\Livewire\Teacher\Anak\Form;

use App\Models\AnakTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadDataTable' => 'reloadData'];
    public $userid;
    private $collection;

    public function mount($user_id)
    {
        $this->userid = $user_id;
        $this->reloadData();
    }

    public function render()
    {
        //cek apakah collection kosong
        if (!$this->collection) {
            $this->reloadData();
        }


        return view('livewire.teacher.anak.form.data', ['collection' => $this->collection, 'userid' => $this->userid]);
    }

    public function reloadData()
    {
        $this->collection = $this->loadData();
    }

    public function loadData()
    {
        return AnakTeacher::where('user_id', $this->userid)->paginate(5);
    }

    public function getResultsProperty()
    {
        return $this->collection ? $this->collection->items() : collect(); // Mengambil data items dari objek paginasi
    }

    /**Edit */
    public function editAnak($id)
    {
        $this->emit('editAnak', $id);
    }

    /**Delete */
    public function deleteAnak($id)
    {
        $this->emit('deleteAnak', $id);
    }


} 
