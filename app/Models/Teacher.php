<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'ibu_kandung',
        'nik',
    ];
}
