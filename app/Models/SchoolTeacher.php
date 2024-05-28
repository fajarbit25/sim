<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama_sekolah',
        'npsn_sekolah',
        'alamat_sekolah',
    ];
}
