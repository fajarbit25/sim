<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipetransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'tipe',
    ];
}
