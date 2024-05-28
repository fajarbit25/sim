<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdNilaiPelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'mapel_id',
       'aspek',
       'kd',
       'nilai',
    ];
}
