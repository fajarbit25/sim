<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kompetensi',
        'jenis',
        'nis',
        'tanggal_masuk',
        'sekolah_asal',
        'npsn_sekolah',
        'nomor_ujian',
        'nomor_ijazah',
        'nomor_skhu',
        'bahasa_indonesia',
        'matematika',
        'ipa',
    ];
}
