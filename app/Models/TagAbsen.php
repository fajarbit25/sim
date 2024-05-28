<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagAbsen extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'tag_absen',
        'user_id',
    ];
}
