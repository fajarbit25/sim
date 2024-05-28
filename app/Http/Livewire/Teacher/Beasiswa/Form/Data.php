<?php

namespace App\Http\Livewire\Teacher\Beasiswa\Form;

use App\Models\BeasiswaTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{ 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadDataTable' => 'reloadData'];

    private $collection;

    public $userid;
    public $jenis;
    public $keterangan;
    public $tahun_mulai;
    public $tahun_akhir;
    public $masih_menerima;

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
        return BeasiswaTeacher::where('user_id', $this->userid)->paginate(5);
    }

    public function render()
    {
        if(!$this->collection){
            $this->reloadData();
        }
        return view('livewire.teacher.beasiswa.form.data', [
            'collection'    => $this->collection,
            'userid'        => $this->userid,
        ]);
    }

    public function getResultsProperty()
    {
        return $this->collection ? $this->collection->items() : collect(); // Mengambil data items dari objek paginasi
    }

    /**Edit */
    public function editBeasiswa($id)
    {
        $this->emit('editBeasiswa', $id);
    }

    /**Delete */
    public function deleteBeasiswa($id)
    {
        $this->emit('deleteBeasiswa', $id);
    }
}
