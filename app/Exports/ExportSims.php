<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class ExportSims implements FromCollection
class ExportSims implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('siswa.excel', [
            'user'  => User::where('level', 4)
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->join('rooms', 'rooms.idkelas', '=', 'users.kelas', 'left')
                        ->join('registers', 'registers.user_id', '=', 'users.id', 'left ')
                        ->get()
        ]);
    }
}