<?php

namespace App\Http\Livewire\Teacher\Buku\Form;

use App\Models\BukuTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    protected $listeners = ['loadDataTable' => 'reloadData'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userid;
    private $collection;


    public function mount($user_id)
    {
        $this->userid = $user_id;
        $this->reloadData();
    }

    public function reloadData()
    {
        $this->collection = $this->loadData();
    }

    public function loadData()
    {
        return BukuTeacher::where('user_id', $this->userid)->paginate(5);
    }

    public function render()
    {
        if(!$this->collection){
            $this->reloadData();
        }
        return view('livewire.teacher.buku.form.data', [
            'collection'    => $this->collection,
            'userid'        => $this->userid,
        ]);
    }

    public function getResultsProperty()
    {
        $this->collection ? $this->collection->items() : collect();
    }

    /**Edit */
    public function editBuku($id)
    {
        $this->emit('editBuku', $id);
    }

    /**Delete */
    public function deleteBuku($id)
    {
        $this->emit('deleteBuku', $id);
    }
}
