<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkDailyReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto',
        'tanggal',
        'keterangan',
        'tab_submenu',
        'updated_by',
    ];
}
