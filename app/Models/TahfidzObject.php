<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahfidzObject extends Model
{
    use HasFactory;
    protected $fillable = [
        'ta',
        'semester',
        'tingkat',
        'surah_id',
        'campus_id',
    ];
}
