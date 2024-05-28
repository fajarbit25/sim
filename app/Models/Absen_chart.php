<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen_chart extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'tanggal_absen',
        'hari_absen',
        'izin',
        'sakit',
        'alfa',
    ];
}
