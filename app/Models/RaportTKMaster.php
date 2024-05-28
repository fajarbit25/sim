<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTKMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'materi',
        'submateri',
    ];
}
