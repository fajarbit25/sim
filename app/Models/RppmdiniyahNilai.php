<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RppmdiniyahNilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rppm_diniyah_id',
        'nilai',
    ];
}
