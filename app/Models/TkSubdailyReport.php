<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkSubdailyReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_report',
        'kelas',
        'tipe',
        'deskripsi',
        'updated_by',
        'foto',
    ];
}
