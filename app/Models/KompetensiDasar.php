<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiDasar extends Model
{
    use HasFactory;
    protected $fillable = [
        'idmapel',
        'kelas',
        'aspek',
        'kode',
        'deskripsi',
        'campus_id',
    ];
}
