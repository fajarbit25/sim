<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkKaldik extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'files',
        'file_name',
        'ta',
    ];
}
