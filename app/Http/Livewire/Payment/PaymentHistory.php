<?php

namespace App\Http\Livewire\Payment;

use App\Models\Invoice;
use App\Models\PaymentJenisTagihan;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentHistory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading;
    public $jenis = 'All';
    public $kelas = 'All';
    public $start;
    public $end;

    public $dataJenis;
    public $dataKelas;
    protected $dataTagihan;
    public $detailTransaksi;

    public function loadAll()
    {
        $this->getDataJenis();
        $this->getDataKelas();
        $this->getDataTagihan();
    }

    public function mount()
    {
        $thisMonth = date('Y-m');
        $startDate = $thisMonth . "-01";
        
        // Menggunakan DateTime untuk mendapatkan tanggal akhir bulan ini
        $date = new \DateTime($startDate);
        $date->modify('last day of this month');
        $endDate = $date->format('Y-m-d');
        
        $this->start = $startDate;
        $this->end = $endDate;

    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.payment.payment-history', [
            'dataTagihan'   => $this->dataTagihan,
        ]);
    }

    public function getDataJenis()
    {
        $jenis = PaymentJenisTagihan::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataJenis = $jenis;
    }

    public function getDataKelas()
    {
        $kelas = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $kelas;
    }

    public function getDataTagihan()
    {
        if($this->jenis == 'All' && $this->kelas == 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->whereBetween('invoices.updated_at', [$this->start, $this->end])
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode', 'payment_type',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis == 'All' && $this->kelas != 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('rooms.tingkat', $this->kelas) //kondisi filter
                    ->whereBetween('invoices.updated_at', [$this->start, $this->end])
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode', 'payment_type',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis != 'All' && $this->kelas == 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('jenis_transaksi', $this->jenis) //kondisi filter
                    ->whereBetween('invoices.updated_at', [$this->start, $this->end])
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode', 'payment_type',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }elseif($this->jenis != 'All' && $this->kelas != 'All'){
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->where('rooms.tingkat', $this->kelas)->where('jenis_transaksi', $this->jenis) //kondisi filter
                    ->whereBetween('invoices.updated_at', [$this->start, $this->end])
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode', 'payment_type',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'rooms.tingkat', 'rooms.kode_kelas')
                    ->orderBy('first_name', 'ASC')->paginate(10);
        }else{
            $data = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                    ->where('invoice_status', 'Paid')->where('invoices.campus_id', Auth::user()->campus_id)
                    ->whereBetween('invoices.updated_at', [$this->start, $this->end])
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'periode', 'payment_type',
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
                    ->select('first_name', 'nis', 'nomor_invoice', 'invoice_date', 'rooms.tingkat', 'rooms.kode_kelas', 'description', 'payment_type',
                    'amount', 'invoices.invoice_status', 'jenis_transaksi', 'kode_transaksi', 'users.email', 'users.phone', 'invoices.idiv')
                    ->first();
        $this->detailTransaksi = $data;
    }
}
