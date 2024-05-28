<?php

namespace App\Exports;

use App\Models\AbsenApi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsenGuru implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $mulai;
    protected $sampai;

    public function __construct($mulai, $sampai)
    {
        $this->mulai = $mulai;
        $this->sampai = $sampai;
    }

    public function collection()
    {
        return AbsenApi::join('users', 'users.id', '=', 'absen_apis.user_id')
                    ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'absen_apis.user_id')
                    ->where('absen_apis.campus_id', Auth::user()->campus_id)
                    ->whereBetween('tanggal', [$this->mulai, $this->sampai])
                    ->select('first_name as name', 'nip', 'jam_masuk', 'jam_pulang')
                    ->get();
    }

    /**Heading */
    public function headings(): array
    {
        return [
            'Nama', 'NIP', 'Jam Masuk', 'Jam Pulang'
        ];
    }
}
