<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkDailyReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto',
        'tanggal',
        'topik',
        'subtopik',
        'menghafal',
        'menulis',
        'murojaah',
        'sentra',
        'subsentra',
       'bahasa',
        'inggris',
        'arab',
        'updated_by',
        'kelas',
    ];
}
