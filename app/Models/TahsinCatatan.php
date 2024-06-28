<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahsinCatatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'ta',
        'semester',
        'kelas',
        'user_id',
        'catatan',
        'tanggal_rapor',
    ];
}
