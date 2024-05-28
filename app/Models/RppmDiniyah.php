<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RppmDiniyah extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'semester',
        'bulan',
        'pekan',
        'kelompok_id',
        'topik_id',
        'subtopik_id',
        'segment_materi',
        'materi',
        'kegiatan',
    ];
}
