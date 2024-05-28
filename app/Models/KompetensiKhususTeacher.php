<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiKhususTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'punya_lisensi_kepsek',
        'nuks',
        'keahlian_lab',
        'menangani_keb_khusus',
        'keahlian_braile',
        'keahlian_bhs_isyarat',
    ];
}
