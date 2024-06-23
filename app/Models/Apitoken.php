<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apitoken extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'keterangan',
        'user_id',
        'chat_id_telegram',
    ];
}
