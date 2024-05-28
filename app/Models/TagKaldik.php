<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagKaldik extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'tag_name',
        'color',
    ];
}
