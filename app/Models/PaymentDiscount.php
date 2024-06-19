<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDiscount extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'jenis_discount',
        'deskripsi',
        'total_discount',
        'deskripsi_discount',
    ];
}
