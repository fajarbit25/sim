<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kk',
        'agama',
        'npwp',
        'nama_npwp',
        'kewarganegaraan',
        'negara',
        'status_perkawinan',
        'nama_pasangan',
        'nip_pasangan',
        'pekerjaan_pasangan',
    ];
}
