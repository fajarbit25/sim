<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = 'idsm';
    protected $fillable = [
        'semester_kode',
        'tahun_ajaran',
        'is_active',
    ];
}
