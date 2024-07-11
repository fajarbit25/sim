<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahfidzFaturrahman extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'ta',
        'semester',
        'kelas',
        'user_id',
        'deskripsi',
        'nilai',
    ];
}
