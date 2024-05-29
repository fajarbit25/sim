<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    public function searchableAs(): string
    {
        return 'posts_index';
    }
    use HasFactory;
    protected $primaryKey = 'idmapel';
    protected $fillable = ['kode_mapel', 'nama_mapel', 'mapel_campus', 'is_active', 'jenis', 'kkm'];
}
