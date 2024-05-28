<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RaportSdController extends Controller
{
    public function __construct()
    {
        
    }

    public function kd():View
    {
        $data = [
            'title'     => 'Kompetensi Dasar',
        ];
        return view('raport.sd.kd', $data);
    }
}
