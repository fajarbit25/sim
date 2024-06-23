<?php

namespace App\Http\Livewire\Payment;

use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentDiscount;
use App\Models\PaymentDiscountInvoice;
use App\Models\PaymentDiscountUser;
use App\Models\PaymentJenisTagihan;
use App\Models\Room;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $loading = false;
    public $jenis;
    public $kelas;
    public $discount;
    public $dataKelas;
    public $totalPrice = 0;
    public $due_date = '0000-00-00';
    public $notif;
    private $dataTagihan;
    public $dataDiscount;
    public $userIdDiscount;
    public $paymentDiscount;
    public $dataJenisTagihan;
    public $inputJenis;

    protected $rules = [
        'jenis'     => 'required',
        'kelas'     => 'required',
    ];

    public function mount()
    {
        $this->getDataKelas();
        $this->getPaymentJenisTagihan();
    }
    public function render()
    {
        $this->loadAll();
        return view('livewire.payment.payment-master', [
            'dataTagihan'   => $this->dataTagihan,
        ]);
    }

    public function loadAll()
    {
        if($this->kelas){
            $this->getDataTagihan();
        }
        $this->getPaymentDiscount();
        if($this->userIdDiscount){
            $this->loadDataDiscountUser();
        }
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $data;
    }

    public function createInvoice()
    {
        $this->due_date = "0000-00-00";
        $this->validate();
        $dataSiswa = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                            ->where('users.level', '4')->where('users.campus_id', Auth::user()->campus_id)
                            ->where('rooms.tingkat', $this->kelas)
                            ->select('users.id')->get();
        foreach($dataSiswa as $items){
            $diskon = PaymentDiscountUser::join('payment_discounts', 'payment_discounts.id', '=', 'payment_discount_users.discount_id')
                        ->where('payment_discount_users.user_id', $items->id)->where('jenis', $this->jenis)
                        ->sum('total_discount');

            Payment::create([
                'campus_id'     => Auth::user()->campus_id,
                'user_id'       => $items->id,
                'tipe'          => 'IN',
                'jenis'         => $this->jenis,
                'qty'           => 1,
                'total_price'   => $this->totalPrice-$diskon,
                'potongan'      => $diskon,
                'payment_fee'   => 0,
                'status'        => 'Unpaid',
                'check_list'    => '0',
                'due_date'      => $this->due_date,
            ]);
        }
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data Tagihan dibuat!',
        ];
        $this->showAlert();    
    }

    public function setAutoSend()
    {
        $this->validate([
            'due_date'  => 'required|integer|min:1|max:31',
        ]);
        Payment::join('users', 'users.id', '=', 'payments.user_id')
                ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
                ->where('users.level', '4')->where('users.campus_id', Auth::user()->campus_id)
                ->where('rooms.tingkat', $this->kelas)->where('payments.jenis', $this->jenis)
                ->where('check_list', '1')
                ->update([
                    'due_date'      => $this->due_date,
                ]);
        $this->notif = [
            'status'    => 200,
            'message'   => 'Invoice akan dikirim pada tanggal '.$this->due_date. ' setiap Bulan',
        ];
        $this->closeModal();
        $this->showAlert();
        $this->due_date = '0000-00-00';
    }

    public function getDataTagihan()
    {
        $data = Payment::join('users', 'users.id', '=', 'payments.user_id')
                    ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('students', 'students.user_id', '=', 'payments.user_id')
                    ->join('registers', 'registers.user_id', '=', 'payments.user_id')
                    ->join('payment_jenis_tagihans', 'payment_jenis_tagihans.id', '=', 'payments.jenis')
                    ->where('users.level', '4')->where('users.campus_id', Auth::user()->campus_id)
                    ->where('rooms.tingkat', $this->kelas)->where('payments.jenis', $this->jenis)
                    ->select('first_name', 'nis', 'nisn', 'rooms.kode_kelas', 'rooms.tingkat', 'tipe', 'payment_jenis_tagihans.jenis as jenis', 'payments.status',
                    'qty', 'total_price', 'potongan', 'jenis_potongan', 'payment_fee', 'payments.status', 'users.id as user_id', 'check_list', 'payments.id', 'due_date')
                    ->paginate(10);
        $this->dataTagihan = $data;
    }

    public function modalPotongan($user_id)
    {
        $this->userIdDiscount = $user_id;
        $this->loadDataDiscountUser();
        $this->emit('modalPotongan');
    }

    public function loadDataDiscountUser()
    {
        $data = PaymentDiscountUser::join('payment_discounts', 'payment_discounts.id', '=', 'payment_discount_users.discount_id')
                ->where('user_id', $this->userIdDiscount)->where('jenis', $this->jenis)
                ->select('payment_discount_users.id as idDiscountUser', 'payment_discounts.jenis_discount', 'payment_discounts.total_discount')->get();
        $this->dataDiscount = $data;
    }

    public function getPaymentDiscount()
    {
        $data = PaymentDiscount::where('campus_id', Auth::user()->campus_id)->get();
        $this->paymentDiscount = $data;
    }

    public function addDiscount()
    {
        //load data diskon
        $loadDataDiscount = PaymentDiscount::findOrFail($this->discount);

        //simpan data diskon untuk user
        PaymentDiscountUser::create([
            'campus_id'     => Auth::user()->campus_id,
            'user_id'       => $this->userIdDiscount,
            'discount_id'   => $this->discount,
            'jenis'         => $this->jenis,
        ]);

        //update data tagihan
        $payment = Payment::where('user_id', $this->userIdDiscount)->where('campus_id', Auth::user()->campus_id)
                    ->where('jenis', $this->jenis)->first();
        $priceOld = $payment->total_price;
        $potonganOld = $payment->potongan;

        //Update
        $payment->update([
            'total_price'   => $priceOld-$loadDataDiscount->total_discount,
            'potongan'      => $potonganOld+$loadDataDiscount->total_discount,
        ]);

        //loadData table discount
        $this->loadDataDiscountUser();
    }

    public function removeDiscount($id)
    {
        $discountUser = PaymentDiscountUser::findOrFail($id);

        //load data diskon
        $loadDataDiscount = PaymentDiscount::findOrFail($discountUser->discount_id);

        //update data tagihan
        $payment = Payment::where('user_id', $discountUser->user_id)->where('campus_id', Auth::user()->campus_id)
                    ->where('jenis', $this->jenis)->first();
        $priceOld = $payment->total_price;
        $potonganOld = $payment->potongan;

        //Update
        $payment->update([
            'total_price'   => $priceOld+$loadDataDiscount->total_discount,
            'potongan'      => $potonganOld-$loadDataDiscount->total_discount,
        ]);

        //hapus data diskon user
        $discountUser->delete();

        //loadData table discount
        $this->loadDataDiscountUser();

    }

    public function modalJenis()
    {
        $this->emit('modalJenis');
    }

    public function getPaymentJenisTagihan()
    {
        $data = PaymentJenisTagihan::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataJenisTagihan = $data;
    }

    public function addJenis()
    {
        $this->validate([
            'inputJenis'  => 'required',
        ]);
        PaymentJenisTagihan::create([
            'campus_id'     => Auth::user()->campus_id,
            'jenis'         => $this->inputJenis,
        ]);

        $this->inputJenis = "";
        $this->getPaymentJenisTagihan();
    }

    public function removeJenis($id)
    {
        $cek = Payment::where('jenis', $id)->count();
        if($cek != 0){
            $this->notif = [
                'status'    => 200,
                'message'   => 'Tidak dapat menghapus data aktif!',
            ];
            $this->showAlert();  
        }else{
            $jenis = PaymentJenisTagihan::findOrFail($id);
            $jenis->delete();
        }
        $this->getPaymentJenisTagihan();
    }

    public function updateCheckList($id)
    {
        $payment = Payment::where('id', $id)->first();

        if($payment->check_list == '0'){
           Payment::where('id', $id)->update([
                'check_list'    => '1',
            ]);
        }elseif($payment->check_list == '1'){
           Payment::where('id', $id)->update([
                'check_list'    => '0',
            ]);
        }
    }

    public function checkAll()
    {
        Payment::join('users', 'users.id', '=', 'payments.user_id')
                    ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->where('rooms.tingkat', $this->kelas)->where('jenis', $this->jenis)
                    ->update([
                        'check_list'    => '1',
                    ]);
    }

    public function kirimTagihan()
    {
        $semester = Semester::where('is_active', 'true')->first();
        $ta = $semester->tahun_ajaran;
        $sm = $semester->semester_kode;
        if($sm == '1'){
            $semesterKode = 'Ganjil';
        }else{
            $semesterKode = 'Genap';
        }

        $payment = Payment::join('users', 'users.id', '=', 'payments.user_id')
                    ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('payment_jenis_tagihans', 'payment_jenis_tagihans.id', '=', 'payments.jenis')
                    ->where('rooms.tingkat', $this->kelas)->where('payments.jenis', $this->jenis) 
                    ->where('check_list', '1')->where('due_date', date('Y-m-d'))
                    ->where('check_list', '1')->select('payments.id as kode_transaksi', 'total_price', 'payments.jenis', 'payments.campus_id', 'due_date',
                    'first_name', 'payments.user_id', 'payment_jenis_tagihans.jenis as jenis_transaksi', 'payment_jenis_tagihans.id as id_jenis_transakis')->get();

        foreach($payment as $item){
            Payment::where('id', $item->kode_transaksi)->update(['due_date', date('Y-m-d')]);
            $countInvoice = Invoice::where('campus_id', Auth::user()->campus_id)->count();

            if(date('m') == '01'){
                $bulan = 'I';
            }elseif(date('m') == '02'){
               $bulan = 'II'; 
            }elseif(date('m') == '03'){
                $bulan = 'III'; 
             }elseif(date('m') == '04'){
                $bulan = 'IV'; 
             }elseif(date('m') == '05'){
                $bulan = 'V'; 
             }elseif(date('m') == '06'){
                $bulan = 'VI'; 
             }elseif(date('m') == '07'){
                $bulan = 'VII'; 
             }elseif(date('m') == '08'){
                $bulan = 'VIII'; 
             }elseif(date('m') == '09'){
                $bulan = 'IX'; 
             }elseif(date('X') == '10'){
                $bulan = 'II'; 
             }elseif(date('m') == '11'){
                $bulan = 'XI'; 
             }elseif(date('m') == '12'){
                $bulan = 'XII'; 
             }

             //generate campus_id menjadi nama satuan pendidikan
            if($item->campus_id == '1'){
                $campusName = "";
            }elseif($item->campus_id == '2'){
                $campusName = "-TKIT";
            }elseif($item->campus_id == '3'){
                $campusName = "-SDIT";
            }elseif($item->campus_id == '4'){
                $campusName = "-SMPIT";
            }elseif($item->campus_id == '5'){
                $campusName = "-SMKIT";
            }

            //set status apabila tagihan 0
            if($item->total_price == 0){
                $status = 'Paid';
                $paymentType = 'iqis';
            }else{
                $status = 'Unpaid';
                $paymentType = null;
            }

            $invoice = Invoice::create([
                'user_id'           => $item->user_id,
                'jenis_transaksi'   => $item->jenis_transaksi,
                'tipe_transaksi'    => 'IN',
                'kode_transaksi'    => $item->kode_transaksi,
                'nomor_invoice'     => "0".$item->id_jenis_transakis.Auth::user()->campus_id."00".$countInvoice."/INV/IQIS/".$bulan."/".date('Y'),
                'invoice_date'      => date('Y-m-d'),
                'amount'            => $item->total_price,
                'invoice_status'    => $status,
                'description'       => "Tagihan ".$item->jenis_transaksi." Semester ".$semesterKode.", Tahun ajaran ".$ta.", Siswa ".$item->first_name." Ibnul Qayyim Islamic School",
                'campus_id'         => Auth::user()->campus_id,
                'payment_type'      => $paymentType,
            ]);

            /**insert data diskon per invoice */
            $userDiscount = PaymentDiscountUser::where('user_id', $item->user_id)->get();
            foreach($userDiscount as $item){
                PaymentDiscountInvoice::create([
                    'invoice_id'    => $invoice->nomor_invoice,
                    'discount_id'   => $item->discount_id,
                ]);
            }
 
        }


        $this->notif = [
            'status'    => 200,
            'message'   => 'Invoice Terkirim!',
        ];
        $this->showAlert(); 
    }

    public function createAutoSend()
    {
        $this->emit('modalAutoSend');
    }

    public function confirmDeleteSelected()
    {
        $this->emit('confirmDelete');
    }

    public function deleteSelected()
    {
        Payment::join('users', 'users.id', '=', 'payments.user_id')
                ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                ->where('rooms.tingkat', $this->kelas)
                ->where('jenis', $this->jenis)
                ->where('check_list', '1')
                ->delete();
        
        $this->emit('closeModal');
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data Dihapus!',
        ];
        $this->showAlert();
    }

    public function closeModal()
    {
        $this->emit('closeModal');
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
