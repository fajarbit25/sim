<?php

namespace App\Http\Livewire\Teacher;

use App\Models\SertifikasiTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Sertifikasi extends Component
{
    public $user_id;
    

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //protected $listenersDelete = ['deleteConfirmed']; //Mendengarkan event 'delete'
    protected $listeners = ['reloadDataTable' => 'listenForReloadDataTable']; // Mendengarkan event 'reloadDataTable'

    public $isClicked = false; //aminasi

    public $selectedId;

    private $sertifikasi; // Property untuk menyimpan data dari query



    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->reloadData(); // Memuat data saat mounting komponen

    }
    
    public function render()
    {
        // Inisialisasi $sertifikasi jika belum ada
        if (!isset($this->sertifikasi)) {
            $this->reloadData();
        }

        return view('livewire.teacher.sertifikasi', ['result' => $this->sertifikasi]); // Menggunakan $this->sertifikasi
    }

    public function loadData()
    {
        return SertifikasiTeacher::where('user_id', $this->user_id)->paginate(10);
    }

    public function reloadData()
    {
        $this->sertifikasi = $this->loadData(); // Menyimpan data dalam $this->sertifikasi
    }

    public function getResultsProperty()
    {
        return $this->sertifikasi->items(); // Mengambil data items dari objek paginasi
    }

    public function listenForReloadDataTable()
    {
        $this->reloadData(); // Mengeksekusi reloadData saat menerima event 'reloadDataTable'
    }
 
    public function editSertifikasi($id)
    {
        $this->emit('editSertifikasi', $id); // Emit event editSertifikasi dengan ID sebagai parameter
    }

    public function deleteSertifikasi($id)
    {
        $this->emit('deleteSertifikasi', $id); //Emit event deleterSertifikasi by ID
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked; // Aminasi pada button
    }
}
