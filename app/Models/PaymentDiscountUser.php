<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDiscountUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'campus_id',
        'user_id',
        'discount_id',
    ];
}
