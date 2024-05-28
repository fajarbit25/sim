<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulirinformation extends Model
{
    use HasFactory;
    protected $fillable = [
       'idformulir',
       'campus_id',
       'pesan',
    ];
}
