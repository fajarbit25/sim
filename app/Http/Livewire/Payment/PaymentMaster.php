<?php

namespace App\Http\Livewire\Payment;

use App\Models\Payment;
use App\Models\PaymentDiscount;
use App\Models\PaymentDiscountUser;
use App\Models\PaymentJenisTagihan;
use App\Models\Room;
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
        $this->validate();
        $dataSiswa = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                            ->where('users.level', '4')->where('users.campus_id', Auth::user()->campus_id)
                            ->where('rooms.tingkat', $this->kelas)
                            ->select('users.id')->get();
        foreach($dataSiswa as $items){
            $diskon = PaymentDiscountUser::join('payment_discounts', 'payment_discounts.id', '=', 'payment_discount_users.discount_id')
                        ->where('payment_discount_users.user_id', $items->id)->sum('total_discount');

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
            ]);
        }
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data Tagihan dibuat!',
        ];
        $this->showAlert();    
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
                    ->select('first_name', 'nis', 'nisn', 'rooms.kode_kelas', 'rooms.tingkat', 'tipe', 'payment_jenis_tagihans.jenis as jenis', 
                    'qty', 'total_price', 'potongan', 'jenis_potongan', 'payment_fee', 'payments.status', 'users.id as user_id')
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
                ->where('user_id', $this->userIdDiscount)
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

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}
