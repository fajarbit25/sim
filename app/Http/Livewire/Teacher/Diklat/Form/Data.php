<?php

namespace App\Http\Livewire\Teacher\Diklat\Form;

use App\Models\DiklatTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadDataTable' => 'reloadData'];
    private $collection;
    public $userid;

    public function mount($user_id)
    {
        $this->userid = $user_id;
    }

    public function reloadData()
    {
        $this->collection = $this->loadData();
    }

    public function loadData()
    {
        return DiklatTeacher::where('user_id', $this->userid)->paginate(5);
    }

    public function getResultsProperty()
    {
        $this->collection ? $this->collection->items() : collect();
    }

    public function render()
    {
        if(!$this->collection){
            $this->reloadData();
        }
        return view('livewire.teacher.diklat.form.data', [
            'collection'    => $this->collection,
            'userid'        => $this->userid,
        ]);
    }

    /**Edit */
    public function editDiklat($id)
    {
        $this->emit('editDiklat', $id);
    }

    /**delete */
    public function deleteDiklat($id)
    {
        $this->emit('deleteDiklat', $id);
    }
}
