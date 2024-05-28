<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'amount',
        'name',
        'account_id',
        'bank_name',
        'confirm_status',
        'confirm_by',
        'evidence',
        'campus_id',
    ];
}
