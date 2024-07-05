<?php

namespace App\Http\Livewire\Payment\Ortu;

use App\Models\Confirmpayment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManualPayment extends Component
{
    use WithFileUploads;
    public $loading = false;

    public $bank;
    public $nama;
    public $norek;
    public $firstAmount;
    public $amount;
    public $evidence;
    public $notif;
    public $btnBack = 0;
    public $txid;
    public $invoice;
    public $invoiceId;

    public function mount($txid)
    {
        $this->txid = $txid;
        $cekInvoice = Invoice::where('kode_transaksi', $this->txid)->select('idiv', 'nomor_invoice', 'amount', 'campus_id')->first();
        $this->invoice = $cekInvoice->nomor_invoice ?? "0";
        $this->invoiceId = $cekInvoice->idiv ?? "0";
        $this->firstAmount = $cekInvoice->amount ?? 0;
    }
    public function render()
    {
        return view('livewire.payment.ortu.manual-payment');
    }

    public function updatedevidence()
    {
        $this->validate([
            'evidence' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function updatedbank()
    {
        
    }

    public function submitKonfirmasi()
    {
        $this->validate([
            'evidence'      => 'required|image|max:1024', // 1MB Max
            'nama'          => 'required',
            'norek'         => 'required',
            'bank'          => 'required',
            'amount'        => 'required',
        ]);

        if($this->invoice != "0"){
 

            $filename   = $this->evidence->getClientOriginalName();
            $this->evidence->storeAs('public/confirm-payment', $filename);
            
            Confirmpayment::create([
                'invoice_id'    => $this->invoice,
                'amount'        => $this->amount,
                'name'          => $this->nama,
                'account_id'    => $this->norek,
                'bank_name'     => $this->bank,
                'confirm_status'=> 0,
                'confirm_by'    => 0,
                'evidence'      => $filename,
                'campus_id'     => Auth::user()->campus_id,
            ]);

            $invoice = Invoice::findOrFail($this->invoiceId);
            $invoice->update([
                'invoice_status'    => 'Pending',
                'payment_type'      => 'Manual Transfer',
            ]);

            $this->btnBack = 1;
            $this->notif = [
                'status'    => 200,
                'message'   => 'Data Berhasil Dikirim, Harap Tunggu Konfrimasi Dari Admin!',
            ];
            $this->showAlert();
        }else{
            $this->notif = [
                'status'    => 500,
                'message'   => 'Tagihan Tidak Ditemukan!',
            ];
            $this->showAlert();
        }
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
