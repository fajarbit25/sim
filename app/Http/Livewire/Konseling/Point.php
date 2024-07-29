<?php

namespace App\Http\Livewire\Konseling;

use App\Models\Campu;
use App\Models\KonselingPoint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Point extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading;
    public $pelanggaran;
    public $point;
    public $kode;

    public $idEdit;
    public $idDelete;
    public $campus;
    public $dataCampus;
    private $dataPelanggaran;
    public $notif;
    public function mount()
    {
        $this->getDataCampus();
    }
    public function render()
    {
        if($this->campus){
            $this->getDataPelanggaran();
        }
        return view('livewire.konseling.point', [
            'dataPelanggaran'   => $this->dataPelanggaran,
        ]);
    }

    public function getDataCampus()
    {
        if(Auth::user()->campus_id == '1'){
            $data = Campu::all();
        }else{
            $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        }
        $this->dataCampus = $data;
    }

    public function modalAdd()
    {
        $this->emit('modalAdd');
    }

    public function modalDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function  edit($id)
    {
        $this->idEdit = $id;
        $data = KonselingPoint::findOrFail($this->idEdit);

        $this->pelanggaran =$data->pelanggaran;
        $this->point =$data->point;
        $this->kode =$data->kode;

        $this->emit('modalAdd');
    }

    public function save()
    {
        $this->validate([
            'pelanggaran'       => 'required',
            'point'             => 'required|integer|min:1',
            'kode'              => 'required',
        ]);

        KonselingPoint::create([
            'campus_id'         => $this->campus,
            'kode'              => $this->kode,
            'pelanggaran'       => $this->pelanggaran,
            'point'             => $this->point,
        ]);

        $this->emit('closeModal');

        $this->pelanggaran = "";
        $this->point = "";
        $this->kode = "";

    }

    public function getDataPelanggaran()
    {
        $data = KonselingPoint::where('campus_id', Auth::user()->campus_id)->orderBy('kode', 'ASC')->paginate(10);
        $this->dataPelanggaran = $data;
    }

    public function update()
    {
        $this->validate([
            'pelanggaran'       => 'required',
            'point'             => 'required|integer|min:1',
            'kode'              => 'required',
        ]);

        $data = [
            'kode'              => $this->kode,
            'pelanggaran'       => $this->pelanggaran,
            'point'             => $this->point,
        ];

        $update = KonselingPoint::findOrFail($this->idEdit);
        $update->update($data);

        $this->emit('closeModal');

        $this->pelanggaran = "";
        $this->point = "";
        $this->kode = "";
        $this->idEdit = "";
    }

    public function delete()
    {
        $this->validate([
            'idDelete'        => 'required',
        ]);

        $data = KonselingPoint::findOrFail($this->idDelete);
        $data->delete();

        $this->idDelete = "";
        $this->emit('closeModal');

        $this->notif = [
            'status'    => 500,
            'message'   => 'Data dihapus!',
        ];
        $this->emit('closeModal');
        $this->showAlert();
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}
