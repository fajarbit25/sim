<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswalog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam',
        'tipe',
        'mapel_id',
    ];
}
