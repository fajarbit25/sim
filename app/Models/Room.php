<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'idkelas';
    protected $fillable = [
        'tingkat',
        'kode_kelas',
        'wali_kelas',
        'campus_id',
    ];
}
