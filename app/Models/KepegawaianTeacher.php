<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepegawaianTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'nip',
        'niy',
        'nuptk',
        'jenis_ptk',
        'sk_pengangkatan',
        'tmt_pengangkatan',
        'lembaga_pengankat',
        'sk_cpns',
        'tmt_pns',
        'golongan',
        'sumber_gaji',
        'kartu_pegawai',
        'karis_karsu',
    ];
}
