<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'bidang_studi',
       'jenjang',
       'gelar_akademik',
       'satuan_pendidikan_formal',
       'tahun_masuk',
       'tahun_lulus',
       'nim',
       'matkul',
       'semester',
       'ipk',
    ];
}
