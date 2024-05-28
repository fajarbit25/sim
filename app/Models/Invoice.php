<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jenis_transaksi', // [PPDB, SERAGAM, SPP, OPERATIONAL, DLL]
        'tipe_transaksi', // [IN, OUT]
        'kode_transaksi', // [COMBINATION DATE, NUMBER, RANDOM]
        'nomor_invoice', // RAND
        'invoice_date',
        'amount',
        'invoice_status', //[PAID, PENDING, UNPAID, CANCEL]
        'description',
        'campus_id',
    ];
}
