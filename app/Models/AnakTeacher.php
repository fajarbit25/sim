<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'status',
        'jenjang_pendidikan',
        'nisn',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'tahun_masuk',
    ];
}
