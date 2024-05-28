<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurulog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kelas_id',
        'tanggal',
        'jam',
        'keterangan',
    ]; 
}
