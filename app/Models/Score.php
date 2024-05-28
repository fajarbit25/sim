<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_score',
        'kelas',
        'mapel',
        'siswa_id',
        'nilai',
        'deskripsi',
        'tanggal_penilaian',
        'bulan_penilaian',
        'grouping',
        'tag_lock',
        'tag_final',
        'user_id',
        'semester',
        'ta',
    ];
}
