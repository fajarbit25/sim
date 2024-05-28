<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('idiv');
            $table->string('user_id');
            $table->string('jenis_transaksi');
            $table->string('tipe_transaksi');
            $table->string('kode_transaksi');
            $table->string('nomor_invoice');
            $table->string('invoice_date');
            $table->string('amount');
            $table->string('invoice_status');
            $table->string('description');
            $table->string('campus_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
