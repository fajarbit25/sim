<?php

namespace App\Http\Livewire\Payment;

use App\Models\PaymentDiscount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PotonganTagihan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading = false;
    public $notif;
    private $result;
    public $idDelete;
    public $idEdit = "";

    public $jenis;
    public $deskripsi;
    public $totalDiscount;

    protected $rules = [
        'jenis'         => 'required',
        'totalDiscount' => 'required',
    ];

    public function loadAll()
    {
        $this->getDataTable();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.payment.potongan-tagihan', [
            'result'    => $this->result,
        ]);
    }

    public function getDataTable()
    {
        $data = PaymentDiscount::where('campus_id', Auth::user()->campus_id)->orderBy('id', 'DESC')->paginate(10);
        $this->result = $data;
    }

    public function modalAdd()
    {
        $this->idEdit = "";
        $this->emit('modalAdd');
    }

    public function saveDiscount()
    {
        $this->validate();
        if(!$this->deskripsi){
            $this->deskripsi = '-';
        }
        PaymentDiscount::create([
            'campus_id'         => Auth::user()->campus_id,
            'jenis_discount'    => $this->jenis,
            'deskripsi'         => $this->deskripsi,
            'total_discount'    => $this->totalDiscount,
        ]);
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data ditambahkan!',
        ];
        $this->showAlert();
        $this->closeModal();
        $this->resetForm();
    }

    public function modalDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function delete()
    {
        $data = PaymentDiscount::findOrFail($this->idDelete);
        $data->delete();
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data dihapus!',
        ];
        $this->showAlert();
        $this->closeModal();
    }

    public function editData($id)
    {
        $this->idEdit = $id;
        $data = PaymentDiscount::findOrFail($this->idEdit);
        
        $this->jenis = $data->jenis_discount;
        $this->deskripsi = $data->deskripsi;
        $this->totalDiscount = $data->total_discount;

        $this->emit('modalAdd');
    }

    public function update()
    {
        $this->validate();
        $dataEdit = [
            'jenis_discount'    => $this->jenis,
            'deskripsi'         => $this->deskripsi,
            'total_discount'    => $this->totalDiscount,
        ];

        $data = PaymentDiscount::findOrFail($this->idEdit);
        $data->update($dataEdit);
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data diperbaharui!',
        ];
        $this->showAlert();
        $this->resetForm();
        $this->idEdit = "";
        $this->closeModal();

    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function  resetForm()
    {
        $this->jenis = "";
        $this->deskripsi = "";
        $this->totalDiscount = "";
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
