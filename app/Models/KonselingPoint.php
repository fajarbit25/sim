<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonselingPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'kode',
        'pelanggaran',
        'point',
    ];
}
