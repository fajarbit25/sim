<?php

namespace App\Http\Controllers;

use App\Models\Confirmpayment;
use App\Models\MiddtransToken;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentDiscountInvoice;
use App\Models\PaymentDiscountUser;
use App\Models\Semester;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PaymentControlller extends Controller
{
    protected $client;


    public function __construct()
    {
        $this->client = new Client();
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

        $periode = date('M-Y');
        $today = date('d');

        $payment = Payment::join('users', 'users.id', '=', 'payments.user_id')
                    ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('payment_jenis_tagihans', 'payment_jenis_tagihans.id', '=', 'payments.jenis')
                    ->where('check_list', '1')
                    ->where('due_date', number_format($today))
                    ->select('payments.id as kode_transaksi', 'total_price', 'payments.jenis', 'payments.campus_id', 'users.phone',
                    'first_name', 'payments.user_id', 'payment_jenis_tagihans.jenis as jenis_transaksi', 'payment_jenis_tagihans.id as id_jenis_transakis')
                    ->get();
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

            //load Data Invoice
            $cekTagihan = Invoice::where('user_id', $item->user_id)->where('jenis_transaksi', $item->jenis_transaksi)
                                    ->where('periode', $periode)->count();

            //set status apabila tagihan 0
            if($item->total_price == 0){
                $status = 'Paid';
                $paymentType = 'sims-iqis';

            }else{
                $status = 'Unpaid';
                $paymentType = null;
            }
        
            if($cekTagihan == 0){

                $message = "Tagihan ".$item->jenis_transaksi." Semester ".$semesterKode.", Tahun ajaran ".$ta.", Siswa ".$item->first_name." Ibnul Qayyim Islamic School";

                $invoice = Invoice::create([
                    'user_id'           => $item->user_id,
                    'jenis_transaksi'   => $item->jenis_transaksi,
                    'tipe_transaksi'    => 'IN',
                    'kode_transaksi'    => $item->kode_transaksi,
                    'nomor_invoice'     => "0".$item->id_jenis_transakis.$item->campus_id."00".$countInvoice."/INV/IQIS".$campusName."/".$bulan."/".date('Y'),
                    'invoice_date'      => date('Y-m-d'),
                    'amount'            => $item->total_price,
                    'invoice_status'    => $status,
                    'description'       => $message,
                    'campus_id'         => $item->campus_id,
                    'payment_type'      => $paymentType,
                    'periode'           => $periode,
                ]);

                /**Send WhatsApp Via fonte */
                $tokens = MiddtransToken::where('campus_id', $item->campus_id)->first();
                $apiKey = $tokens->whatsapp_key;
                
                $response = $this->client->post('https://api.fonnte.com/send', [
                    'headers' => [
                        'Authorization' => $apiKey,
                    ],
                    'form_params' => [
                        'target' => $item->phone,
                        'message' => $message,
                    ],
                ]);

                /**End Send WhatsApp Via fonte */


                /**insert data diskon per invoice */
                $userDiscount = PaymentDiscountUser::where('user_id', $item->user_id)->get();
                foreach($userDiscount as $item){
                    PaymentDiscountInvoice::create([
                        'invoice_id'    => $invoice->nomor_invoice,
                        'discount_id'   => $item->discount_id,
                    ]);
                }
            }
            //Endif
        }
        //Endforeach

        $cekStatusSend = Invoice::whereDate('invoices.created_at', date('Y-m-d'))->get();

        if($cekStatusSend->count() != 0){

            foreach($cekStatusSend->groupBy('campus_id') as $campus => $item){

                //Get Token
                $token = MiddtransToken::where('campus_id', $campus)->first();

                $telegramToken = env('TELEGRAM_TOKEN');
                $telegramChatId = $token->chat_id_telegram;
                $periodeText = $periode; // Anda harus memiliki ini terdefinisi sebelumnya
                $telegramMessage = "Notifikasi Sistem! \nTerdapat ".$cekStatusSend->count()." tagihan, Periode ".$periodeText." Berhasil dikirim!";

                $client = new Client();
                $url = "https://api.telegram.org/{$telegramToken}/sendMessage";

                try {
                    $response = $client->post($url, [
                        'form_params'   => [
                            'chat_id'   => $telegramChatId,
                            'text'      => $telegramMessage,
                        ],
                    ]);

                    $responseBody = json_decode($response->getBody(), true);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Tagihan dikirim!',
                        'data' => $responseBody,
                    ], 200);

                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Gagal mengirim notifikasi',
                        'error' => $e->getMessage(),
                    ], 500);
                }

            }//endforach

        }else{
            return response()->json([
                'status'    => 200,
                'message'   => 'Success'
            ]);

        }//cek status

    }

    public function paymentHistory(): View
    {
        $data = [
            'title'     => 'History Pembayaran',
        ];
        return view('payment.payment-history', $data);
    }
}
