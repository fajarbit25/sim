<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_absen',
        'semester',
        'kelas',
        'mapel',
        'user_id',
        'siswa_id',
        'absensi',
        'keterangan',
        'tanggal_absen',
        'status',
        'campus_id',
    ];
}
