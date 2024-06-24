<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahsinKd extends Model
{
    use HasFactory;
    protected $fillable = [
       'campus_id',
       'ta',
       'semester',
       'tingkat',
       'kode',
       'arabic',
       'bahasa',
    ];
}
