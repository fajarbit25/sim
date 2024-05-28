<?php

namespace App\Http\Livewire\Teacher\Pendidikan\Form;

use App\Models\PendidikanTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['reloadDataTable' => 'reloadData'];
    
    public $userid;
    private $result;

    public function mount($user_id)
    {
        $this->userid = $user_id;
        $this->reloadData();
    }

    public function render()
    {
        // Inisialisasi jika belum ada
        if (!isset($this->result)) {
            $this->reloadData();
        }
        return view('livewire.teacher.pendidikan.form.data', ['collection' => $this->result, 'userid' => $this->userid]); //Mengirim data result ke view
    }

    /**Read */
    public function loadData()
    {
        return PendidikanTeacher::where('user_id', $this->userid)->paginate(2); //Load data dari database
    }

    public function reloadData()
    {
        $this->result = $this->loadData(); //Menganmbil data dari loadData
    }

    public function getResultsProperty()
    {
        return $this->result ? $this->result->items() : collect(); // Mengambil data items dari objek paginasi
    }

    /**Edit */
    public function editPendidikan($id)
    {
        $this->emit('editPendidikan', $id); //Buat event untuk edit
    }

    /**Delete */
    public function deletePendidikan($id)
    {
        $this->emit('deletePendidikan', $id); //Even untuk delete
    }

    
}
