<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MiddtransToken extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'campus_id',
       'merchant_id',
       'client_key',
       'server_key',
       'admin_fee',
       'midtrans_environment',
       'chat_id_telegram',
       'whatsapp_key',
       'status',
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
