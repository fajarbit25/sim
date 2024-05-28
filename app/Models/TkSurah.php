<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkSurah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'arabic_name',
    ];
}
