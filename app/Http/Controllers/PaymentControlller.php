<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;

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
}
