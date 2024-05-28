<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jenis',
        'keterangan',
        'tahun_mulai',
        'tahun_akhir',
        'masih_menerima',
    ];
}
