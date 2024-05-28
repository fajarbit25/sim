<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikasiTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jenis',
        'nomor',
        'tahun',
        'bidang_studi',
        'nrg',
        'nomor_peserta',
    ];
}
