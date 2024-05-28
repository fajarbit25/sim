<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'segment',
        'nama_lengkap',
        'nik',
        'tahun_lahir',
        'pendidikan',
        'pekerjaan',
        'penghasilan',
        'keb_khusus',
    ];
}
