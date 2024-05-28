<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTkNarasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'semester',
        'kelas',
        'ta',
        'tanggal',
        'fase',
        'agama',
        'jati_diri',
        'literasi',
        'refleksi_guru',
        'refleksi_orang_tua',
    ];
}
