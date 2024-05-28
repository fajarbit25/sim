<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_id',
        'nominal',
        'saldo_awal',
        'saldo_akhir',
        'campus_id',
        'trx_by',
    ];
}
