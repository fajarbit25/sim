<?php

namespace App\Helpers;

class DateHelper
{
    public static function hariDalamBahasaIndonesia($dayInEnglish)
    {
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        return $hari[$dayInEnglish] ?? $dayInEnglish;
    }
}
