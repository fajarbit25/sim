<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahfidzSurah extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'bahasa',
        'arab',
        'jus',
        'ayat',
    ];
}
