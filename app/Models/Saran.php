<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis',
        'ta',
        'semester',
        'user_id',
        'saran',
    ];
}
