<?php

namespace App\Http\Livewire\Payment;

use App\Models\MiddtransToken as ModelsMiddtransToken;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MiddtransToken extends Component
{
    public $loading = false;
    public $merchant;
    public $server;
    public $client;
    public $notif;
    public $chat_id_telegram;
    public $admin_fee;
    public $midtransEnvironment;

    protected $rules = [
        'merchant'  => 'required',
        'server'    => 'required',
        'client'    => 'required',
        'admin_fee' => 'required',
        'midtransEnvironment'   => 'required',
    ];

    public function mount()
    {
        $this->getToken();
    }

    public function render()
    {
        return view('livewire.payment.middtrans-token');
    }

    public function getToken()
    {
        $data = ModelsMiddtransToken::where('campus_id', Auth::user()->campus_id)->where('user_id', Auth::user()->id)->first();
        
        $this->merchant = $data->merchant_id ?? "";
        $this->server = $data->server_key ?? "";
        $this->client = $data->client_key ?? "";
        $this->admin_fee = $data->admin_fee ?? 0;
        $this->chat_id_telegram = $data->chat_id_telegram ?? "";
        $this->midtransEnvironment = $data->midtrans_environment ?? "";
    }

    public function submitToken()
    {
        $this->validate();

        $data = [
            'user_id'           => Auth::user()->id,
            'campus_id'         => Auth::user()->campus_id,
            'merchant_id'       => $this->merchant,
            'client_key'        => $this->client,
            'server_key'        => $this->server,
            'admin_fee'         => $this->admin_fee,
            'midtrans_environment'   => $this->midtransEnvironment,
            'chat_id_telegram'  => $this->chat_id_telegram,
            'status'            => 'Active'
        ];

        $cekToken = ModelsMiddtransToken::where('user_id', Auth::user()->id)->where('campus_id', Auth::user()->campus_id)->count();

        if($cekToken <= 0){
            ModelsMiddtransToken::create($data);
        }else{
            ModelsMiddtransToken::where('user_id', Auth::user()->id)->where('campus_id', Auth::user()->campus_id)
                            ->update($data);
        }
        
        $this->notif = [
            'status'    => 200,
            'message'   => 'Token diperbaharui!',
        ];
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
