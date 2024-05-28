<?php

namespace App\Http\Livewire\Teacher\Sertifikasi\Form;

use App\Models\SertifikasiTeacher;
use Livewire\Component;

class Delete extends Component
{
    public $isClicked; //Animasi button
    protected $listeners = ['deleteSertifikasi' => 'listenFormDeleteSertifikasi']; // Mendengarkan even deleteSertifikasi
    public $sertifikasiId;

    public function render()
    {
        return view('livewire.teacher.sertifikasi.form.delete')
                ->with('sertifikasi_id', $this->sertifikasiId);
    }

    public function getId($id)
    {
        $this->sertifikasiId = $id; // Mendefinisikan variabel ID
    }

    public function listenFormDeleteSertifikasi($id)
    {
        $this->getId($id);
    }

    public function delete()
    {
        SertifikasiTeacher::destroy($this->sertifikasiId);

        $this->closeModal();
        $this->emit('reloadDataTable');

        session()->flash('success', 'Data dihapus!');
    }

    public function closeModal()
    {
        $this->emit('closeModal'); // Emit event untuk menutup modal
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked; // Mejalankan animasi button
        $this->delete(); // Memanggil fungsi delete dengan menggunakan $this->sertifikasiId
    }
}
