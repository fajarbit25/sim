<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jenis',
        'nama',
        'penyelenggara',
        'tahun',
        'peran',
        'tingkat',
        'berapa_jam',
        'sertifikat_diklat',
    ];
}
