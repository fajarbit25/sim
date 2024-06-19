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

    protected $rules = [
        'merchant'  => 'required',
        'server'    => 'required',
        'client'    => 'required',
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
    }

    public function submitToken()
    {
        $this->validate();

        ModelsMiddtransToken::create([
            'user_id'       => Auth::user()->id,
            'campus_id'     => Auth::user()->campus_id,
            'merchant_id'   => $this->merchant,
            'client_key'    => $this->client,
            'server_key'    => $this->server        ,
            'status'        => 'Active'
        ]);
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
