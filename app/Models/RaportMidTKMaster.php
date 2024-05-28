<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportMidTKMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori',
        'subkategori',
        'materi',
        'tujuan',
    ];
}
