<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bidang_studi',
        'urutan',
    ];
}
