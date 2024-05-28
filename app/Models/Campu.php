<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campu extends Model
{
    use HasFactory;
    protected $primaryKey = 'idcampus';
    protected $fillable = [
        'campus_name',
        'npsn',
        'status',
        'bentuk_pendidikan',
        'kepemilikan',
        'sk_pendirian',
        'tanggal_sk',
        'sk_izin_operasi',
        'tanggal_sk_izin_operasi',
        'campus_initial',
        'campus_tingkat',
        'campus_contact',
        'email_campus',
        'campus_kepsek',
        'campus_alamat',
        'yt',
        'fb',
        'ig',
        'tele',
    ];
}
