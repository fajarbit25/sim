<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanKaldik extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'ta',
        'semester',
        'tahun',
        'bulan',
        'he_sekolah',
        'he_semester',
        'pe',
        'jumlah_pe',
        'lock',
    ];
}
