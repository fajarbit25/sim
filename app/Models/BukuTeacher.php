<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'judul',
        'tahun',
        'penerbit',
        'isbn',
    ];
}
