<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'ta',
        'semester',
        'kelas',
        'user_id',
        'pelanggaran_id',
        'ket',
        'foto',
        'created_by',
    ];
}
