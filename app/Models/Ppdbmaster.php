<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdbmaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun_id',
        'tahun_penerimaan',
        'gelombang',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
