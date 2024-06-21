<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentDiscountInvoice;
use App\Models\PaymentDiscountUser;
use App\Models\Semester;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;

class PaymentControlller extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function apiSetting() : View
    {
        $data = [
            'title'     => 'Api Setting',
        ];

        return view('payment.api-setting', $data);
    }

    public function potonganTagihan(): View
    {
        $data = [
            'title'     => 'Potongan Tagihan',
        ];
        return view('payment.potongan-tagihan', $data);
    }

    public function paymentMaster(): View
    {
        $data = [
            'title'     => 'Data Master Pembayaran',
        ];
        return view('payment.payment-master', $data);
    }

    public function paymentUnpaid(): View
    {
        $data = [
            'title'     => 'Tagihan belum dikomfirmasi', 
        ];
        return view('payment.payment-unpaid', $data);
    }

    public function sendNotifikasiWA()
    {
        $to = '0895330078691';
        $message = "Testing Notifikasi WA Gateway";
        $send = $this->whatsappService->sendMessage($to, $message);
        if($send){
            return response()->json([
                'message' => 'Berhasil Terkirim!'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Gagal Terkirim!'
            ], 401);
        }
    }

    public function kirimTagihanApi()
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
                    ->where('check_list', '1')->where('due_date', date('Y-m-d'))
                    ->select('payments.id as kode_transaksi', 'total_price', 'payments.jenis', 'payments.campus_id',
                    'first_name', 'payments.user_id', 'payment_jenis_tagihans.jenis as jenis_transaksi', 'payment_jenis_tagihans.id as id_jenis_transakis')->get();
        foreach($payment as $item){
            $countInvoice = Invoice::where('campus_id', $item->campus_id)->withTrashed()->count();
            //generate bulan ke romawi
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
                'nomor_invoice'     => "0".$item->id_jenis_transakis.$item->campus_id."00".$countInvoice."/INV/IQIS".$campusName."/".$bulan."/".date('Y'),
                'invoice_date'      => date('Y-m-d'),
                'amount'            => $item->total_price,
                'invoice_status'    => $status,
                'description'       => "Tagihan ".$item->jenis_transaksi." Semester ".$semesterKode.", Tahun ajaran ".$ta.", Siswa ".$item->first_name." Ibnul Qayyim Islamic School",
                'campus_id'         => $item->campus_id,
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

        return response()->json([
            'status'    => 200,
            'message'   => 'Tagihan dikirim!'
        ], 200);

    }
}
