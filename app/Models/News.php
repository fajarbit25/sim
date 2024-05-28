<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'poster',
        'judul',
        'berita',
        'user_id',
        'posted',
        'post_date',
    ];
}
