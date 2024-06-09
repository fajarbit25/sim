<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RaportController extends Controller
{

    public function index():View
    {
        $data = [
            'title'     => 'Raport Kurikulum Merdeka',
        ];
        return view('raport.km.index', $data);
    }
    
    public function penilaian():View
    {
        $data = [
            'title'         => 'Form Penilaian Raport KM',
        ];
        return view('raport.km.penilaian', $data);
    }
}
