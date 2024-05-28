<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenApi extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'user_id',
        'tanggal',
        'tipe',
        'jam_masuk',
        'jam_pulang',
    ];
}
