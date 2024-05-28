<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'provinsi',
        'idprovinsi',
        'kota',
        'idkota',
        'kec',
        'idkec',
        'kel',
        'idkel',
        'dusun',
        'rt',
        'rw',
        'kode_pos',
        'jalan',
        'status_tempat_tinggal',
        'moda_transportasi',
        'lintang',
        'bujur',
    ];
}
