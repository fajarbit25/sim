<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TkSubdailyReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_daily_report',
        'subketerangan',
        'updated_by',
    ];
}
