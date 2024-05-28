<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurumapel extends Model
{
    use HasFactory;
    protected $primaryKey = 'idmg';
    protected $fillable = [
        'mapel_id',
        'user_id',
        'campus_id',
        'kelas',
    ];
}
