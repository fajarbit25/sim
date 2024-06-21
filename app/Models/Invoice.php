<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'idiv';
    protected $fillable = [
        'user_id',
        'jenis_transaksi', // [PPDB, SERAGAM, SPP, OPERATIONAL, DLL]
        'tipe_transaksi', // [IN, OUT]
        'kode_transaksi', // [COMBINATION DATE, NUMBER, RANDOM]
        'nomor_invoice', // RAND
        'invoice_date',
        'amount',
        'invoice_status', //[PAID, PENDING, UNPAID, CANCEL]
        'payment_type',
        'description',
        'campus_id',
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
