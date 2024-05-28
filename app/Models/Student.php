<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'gender',
        'nisn',
        'nik',
        'kk',
        'tempat_lahir',
        'tanggal_lahir',
        'akta_lahir',
        'agama',
        'kewarganegaraan',
        'negara',
        'anak_ke',
        'pekerjaan_pelajar',
        'penerima_kip',
        'no_kip',
        'nama_kip',
        'alasan_menolak_kip',
        'no_kks',
        'penerima_kps',
        'nomor_kps',
        'layak_pip',
        'alasan_layak_pip',
        'public_token',
    ];
}
