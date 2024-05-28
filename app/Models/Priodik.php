<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priodik extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tinggi',
        'berat',
        'lingkar_kepala',
        'jarak_per_1km',
        'jarak',
        'jam',
        'menit',
        'saudara',
    ];
}
