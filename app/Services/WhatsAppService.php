<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendMessage($to, $message)
    {
        try {
            $this->twilio->messages->create(
                'whatsapp:' . $to,
                [
                    'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER'),
                    'body' => $message
                ]
            );
            Log::info("Message sent to $to");
        } catch (\Exception $e) {
            Log::error("Failed to send message: " . $e->getMessage());
        }
    }
}
