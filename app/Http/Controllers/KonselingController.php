<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class KonselingController extends Controller
{
    public function point():View
    {
        $data = [
            'title'     => 'Point Tata Tertib',
        ];
        return view('konseling.point', $data);
    }

    public function input():View
    {
        $data = [
            'title'     => 'Form Pelanggaran',
        ];
        return view('konseling.input', $data);
    }

    public function siswa($id): View
    {
        $data = [
            'title' => 'Catatan Konseling Siswa',
            'id'    => $id,
        ];

        return view('konseling.siswa', $data);
    }
    
}
