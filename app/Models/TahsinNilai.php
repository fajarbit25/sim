<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TahsinNilai extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
       'ta',
       'semester',
       'kelas',
       'user_id',
       'nilai',
       'jenis_penilaian',
       'kd_id',
       'campus_id',
       'tanggal_raport',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
