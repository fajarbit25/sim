<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SdNilaiPelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'ta',
        'semester',
       'user_id',
       'mapel_id',
       'aspek',
       'kd',
       'nilai',
       'jenis',
       'tampil',
       'non_test',
        'test',
       'tanggal_raport'
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
