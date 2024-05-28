<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nomor_surat_tugas',
        'tanggal_surat_tugas',
        'tmt_tugas',
        'sekolah_induk',
        'keluar_karena',
        'tanggal_keluar',
        'uname_akun_ptk',
        'pass_akun_ptk',
    ];
}
