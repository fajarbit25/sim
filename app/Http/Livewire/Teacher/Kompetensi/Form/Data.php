<?php

namespace App\Http\Livewire\Teacher\Kompetensi\Form;

use App\Models\KompetensiTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['loadDataTable' => 'reloadData']; //Mendengarkan even reload data table

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

        return view('livewire.teacher.kompetensi.form.data', ['collection' => $this->collection, 'userid' => $this->userid]);
    }

    public function reloadData()
    {
        $this->collection = $this->loadData(); //Memanggil fungsi loadData
    }

    public function loadData()
    {
        return KompetensiTeacher::where('user_id', $this->userid)
                                ->orderBy('urutan', 'ASC')->paginate(5); //loadData dari database untuk di kirim ke reloadData
    }

    public function getResultsProperty()
    {
        return $this->collection ? $this->collection->items() : collect(); // Mengambil data items dari objek paginasi
    }

    /**Edit */
    public function editKompetensi($id)
    {
        $this->emit('editKompetensi', $id);//membuat even edit kompetensi untuk di kirim ke komponen edit
    }

    /**Delete */
    public function deleteKompetensi($id)
    {
        $this->emit('deleteKompetensi', $id); //membuat even delete kompetensi untuk di kirim ke komponen delete
    }

}
