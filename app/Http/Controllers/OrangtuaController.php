<?php

namespace App\Http\Controllers;

use App\Models\Campu;
use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\MiddtransToken;
use App\Models\Mutation;
use App\Models\Payment;
use App\Models\PaymentDiscountInvoice;
use App\Models\Score;
use App\Models\Semester;
use App\Models\Siswalog;
use App\Models\Student;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class OrangtuaController extends Controller
{
    /**Construc */
    public function __construct()
    {
        
    }
    /**
     * 
     * Statistik.
     * 
    */
    public function index():view
    {
        $id = Auth::user()->id;
        $semester = Semester::where('is_active', 'true')->first();
        $semesterKode = $semester->semester_kode;
        $ta = $semester->tahun_ajaran;

        $data = [
            'title'     => 'Statistik Siswa',
            'campus'    => Campu::where('idcampus', Auth::user()->campus_id)->first(),
            'students'  => Student::where('user_id', $id)->first(),
            'nilai'     => Score::where('siswa_id', $id)->where('semester', '!=', $semesterKode)->where('ta', '!=',  $ta)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')->get(),
        ];
        return view('ortu.index', $data);
    }


    /**
     * 
     * Nilai Tahfidz.
     *
     */
    public function tahfidz($id):View
    {
        $data = [
            'title'         => 'Tahfidz',
        ];
        return view('ortu.tahfidz', $data);
    }

    /**
     * 
     * E-Raport.
     * 
    */
    public function eraport()
    {
        $id = Auth::user()->id;
        $semester = Semester::where('is_active', 'true')->first();
        $semesterKode = $semester->semester_kode;
        $ta = $semester->tahun_ajaran;

        $data = [
            'title'     => 'E-Raport',
            'campus'    => Campu::where('idcampus', Auth::user()->campus_id)->first(),
            'students'  => Student::where('user_id', $id)->first(),
            'nilai'     => Score::where('siswa_id', $id)->where('semester', $semesterKode)->where('ta', $ta)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')->get(),
            'semester'  => $semesterKode,
            'ta'        => $ta,
        ];
        return view('ortu.eraport', $data);
    }


    /**
     * Invoice
    */
    public function invoice():view
    {
        $data = [
            'title'     => 'Invoice',
            'invoice'   => Invoice::where('user_id', Auth::user()->id)->where('invoice_status', 'Unpaid')->get(),
        ];
        return view('ortu.invoice', $data);
    }

    public function invoiceHistory():view
    {
        $data = [
            'title'     => 'History Pembayaran',
            'invoice'   => Invoice::where('user_id', Auth::user()->id)->where('invoice_status', 'Paid')->get(),
        ];
        return view('ortu.invoice-history', $data);
    }

    public function showInvoice($id)
    {
        /**Data Invoice */
        $loadinv = Invoice::where('kode_transaksi', $id)->first();
        $idinv = $loadinv->idiv;


        $data = [
            'title'     => '#'.$loadinv->nomor_invoice,
            'invoice'   => Invoice::where('kode_transaksi', $id)->first(),
            'confirm'   => Confirmpayment::where('invoice_id', $idinv)->first(),
            'discount'  => PaymentDiscountInvoice::join('payment_discounts', 'payment_discounts.id', '=', 'payment_discount_invoices.discount_id')
                            ->where('invoice_id', $loadinv->nomor_invoice)->select('payment_discounts.jenis_discount', 'payment_discounts.total_discount')
                            ->get(),
            // 'totalDisc'=> PaymentDiscountInvoice::join('payment_discounts', 'payment_discounts.id', '=', 'payment_discount_invoices.discount_id')
            //                 ->where('invoice_id', $loadinv->nomor_invoice)->select('payment_discounts.jenis_discount', 'payment_discounts.total_discount')
            //                 ->sum('payment_discounts.total_discount'),

        ];

        return view('ortu.showInvoice', $data);
    }

    public function checkout(Request $request)
    {
        /**Data Invoice */
        $loadinv = Invoice::where('kode_transaksi', $request->kode_transaksi)->first();
        $idinv = $loadinv->idiv;

        /**Middtrans */
        //Get Token
        $token = MiddtransToken::where('campus_id', Auth::user()->campus_id)->first();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $token->server_key;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        if($token->midtrans_environment == 'Production'){
            \Midtrans\Config::$isProduction = true;
        }elseif($token->midtrans_environment == 'Sandbox'){
            \Midtrans\Config::$isProduction = false;
        }
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $idinv,
                'gross_amount' => $loadinv->amount+$token->admin_fee,
            ),
            'item_details' => array(
                array(
                    'id'        => 'Item-1',
                    'price'     => $loadinv->amount,
                    'quantity'  => 1,
                    'name'      => $loadinv->jenis_transaksi,
                ),
                array(
                    'id'        => 'Admin_fee',
                    'price'     => $token->admin_fee,
                    'quantity'  => 1,
                    'name'      => 'Biaya Admin',
                ),
                
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->first_name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        /**End Middtrans */

        $data = [
            'title'         => 'Checkout',
            'clientKey'     => $token->client_key,
            'snapToken'     => $snapToken,
        ];

        return view('ortu.checkout', $data);
    }

    public function callback(Request $request)
    {
        //Get Token
        $token = MiddtransToken::where('merchant_id', $request->merchant_id)->first();
        $serverKey = $token->server_key;

        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'settlement'){
                Invoice::where('idiv', $request->order_id)->update([
                    'invoice_status'    => 'Paid',
                    'payment_type'      => $request->payment_type,
                ]);

                Payment::where('id', $request->order_id)->update([
                    'status'    => 'Paid',
                ]);

                /**Telegram Notification */
                $invoice = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                                    ->join('registers', 'registers.user_id', '=', 'invoices.user_id')
                                    ->where('idiv', $request->order_id)
                                    ->select('jenis_transaksi', 'first_name', 'periode', 'nis')
                                    ->first();
                $telegramToken = env('TELEGRAM_TOKEN');
                $telegramChatId = $token->chat_id_telegram;

                $jenis = $invoice->jenis_transaksi;
                $periode = $invoice->periode;
                $siswa = $invoice->first_name;
                $kode_transaksi = $request->order_id;
                $metode = $request->payment_type;
                $nis = $invoice->nis;

                $telegramMessage = "Notifikasi Pembayaran! \nPermbayaran : ".$jenis."\n"."Periode : ".$periode."\n"."Nama Siswa : ".$siswa."\n"."Nomor Induk : ".$nis."\nStatus : ".$request->transaction_status."\nMetode Pembayaran : ".$metode."\nKode Transaksi : ".$kode_transaksi;

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
            }

            if($request->transaction_status == 'pending'){
                Invoice::where('idiv', $request->order_id)->update([
                    'invoice_status'    => 'Pending',
                    'payment_type'      => $request->payment_type,
                ]);
            }

        }
    }


    public function showEviden($id)
    {
        $data = Confirmpayment::where('invoice_id', $id)->first();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
