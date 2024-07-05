<?php

namespace App\Http\Livewire\Payment;

use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\Mutation;
use App\Models\PaymentJenisTagihan;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PaymentUnpaid extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $loading = false;
    public $notif;
    public $jenis;
    public $kelas;
    public $idDelete;
    public $idPaid;

    protected $dataTagihan;
    public $detailTransaksi;
    public $dataKelas;
    public $dataJenis;

    public $evidence;
    public $name;
    public $bank;
    public $norek;
    public $nomorInvoice;

    public function loadAll()
    {
        $this->getDataTagihan();
        $this->getDataJenis();
        $this->getDataKelas();
    }

    public function render()
    {
        $this->loadAll();

        return view('livewire.payment.payment-unpaid', [
            'dataTagihan'   => $this->dataTagihan,
        ]);
    }

    public function getDataTagihan()
    {
        if($this->jenis == 'All' && $this->kelas == 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', '!=', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis == 'All' && $this->kelas != 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', '!=', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('rooms.tingkat', $this->kelas) //kondisi filter
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis != 'All' && $this->kelas == 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', '!=', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('jenis_transaksi', $this->jenis) //kondisi filter
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis != 'All' && $this->kelas != 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', '!=', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('rooms.tingkat', $this->kelas)->where('jenis_transaksi', $this->jenis)
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }else{
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', '!=', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }
        

        $this->dataTagihan = $data;
    }

    public function infoTransaksi($id)
    {
        $this->getDetailTransaksi($id);
        $this->getDataTagihan();
        $this->emit('modalDetailTransaksi');
    }

    public function getDetailTransaksi($id)
    {
        $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->where('kode_transaksi', $id)
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'rooms.tingkat', 'rooms.kode_kelas', 'description', 
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'users.email', 'users.phone', 'invoices.idiv')
                    ->first();
        $this->detailTransaksi = $data;
    }

    public function confirmPaid($id)
    {
        $this->idPaid = $id;
        $this->emit('modalPaid');
    }

    public function updatedevidence()
    {
        $this->validate([
            'evidence' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function markPaid()
    {
        $this->validate([
            'evidence'      => 'required|image|max:1024', // 1MB Max
            'name'          => 'required',
            'norek'         => 'required',
            'bank'          => 'required',
        ]);

        $load = Invoice::findOrFail($this->idPaid);
        $load->update([
            'invoice_status'    => 'Paid',
            'payment_type'      => 'sims-iqis',
        ]);

        $saldo = Mutation::where('campus_id', Auth::user()->campus_id)->orderBy('idmt', 'DESC')->first();
        /**Insert data mutasi */
        $mutasi = [
            'inv_id'        => $load->nomor_invoice,
            'nominal'       => $load->amount,
            'saldo_awal'    => $saldo->saldo_akhir,
            'saldo_akhir'   => $saldo->saldo_akhir+$load->amount,
            'campus_id'     => Auth::user()->campus_id,
            'trx_by'        => Auth::user()->id,
        ];

        /**Create Table Konfirmasi */
        $filename   = $this->evidence->getClientOriginalName();
        $this->evidence->storeAs('public/confirm-payment', $filename);

        Confirmpayment::create([
            'invoice_id'    => $load->nomor_invoice,
            'amount'        => $load->amount,
            'name'          => $this->name,
            'account_id'    => $this->norek,
            'bank_name'     => $this->bank,
            'confirm_status'=> 1,
            'confirm_by'    => Auth::user()->id,
            'evidence'      => $filename,
            'campus_id'     => Auth::user()->id,
        ]);

        Mutation::create($mutasi);
        $this->emit('closeModalPaid');
        $this->notif = [
            'status'    => 200,
            'message'   => 'Tagihan Lunas!',
        ];
        $this->showAlert();

    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $data;
    }

    public function getDataJenis()
    {
        $data = PaymentJenisTagihan::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataJenis = $data;
    }

    public function confirmDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function deteleInvoice()
    {
        $invoice = Invoice::findOrFail($this->idDelete);
        $invoice->delete();
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data Dihapus!',
        ];
        $this->idDelete = "";
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
