<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'akta_lahir',
        'kk',
        'ktp',
        'ktp_ortu',
        'foto',
        'updated_by',
    ];
}
