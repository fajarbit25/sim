<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'room_id',
        'tanggal',
        'jam',
        'kegiatan',
        'user_id',
    ];
}
