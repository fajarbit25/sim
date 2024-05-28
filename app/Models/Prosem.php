<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prosem extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'ta',
        'file',
        'update_by',
    ];
}
