<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportMidTkNilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_raport',
        'kategori',
        'subkategori',
        'materi',
        'tujuan',
        'bsb',
        'bsh',
        'mb',
        'bb',

    ];
}
