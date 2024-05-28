<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predikat extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis',
        'nilai_min',
        'nilai_max',
        'deskripsi',
        'campus_id',
    ];
}
