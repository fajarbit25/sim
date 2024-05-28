<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TracertStudy extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'nomor_jazah',
        'skhu',
        'angkatan',
        'kelas_terakhir',
        'campus_id',
    ];

    /**
     * Mengisi primary key secara otomatis dengan UUID ketika membuat record
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Menonaktifkan auto increment
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Memberi tahu laravel bahwa model ini menggunakan primary key bertipe string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
