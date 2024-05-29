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

    public function penilaian():View
    {
        $data = [
            'title'     => 'Form Penilaian',
        ];
        return view('raport.sd.penilaian', $data);
    }
    
    public function raport():view
    {
        $data = [
            'title'     => 'Rapor Siswa',
        ];
        return view('tk.raport.index', $data);
    }
}
