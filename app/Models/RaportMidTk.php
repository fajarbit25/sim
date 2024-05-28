<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportMidTk extends Model
{
    use HasFactory;
    protected $fillable = [
       'campus',
        'kelas',
        'ta',
        'semester',
        'user_id',
        'tanggal',
        'deskripsi',
        'catatan',
    ];
}
