<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTkHafalan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_narasi',
        'materi',
        'kegiatan',
        'nilai',
    ];
}
