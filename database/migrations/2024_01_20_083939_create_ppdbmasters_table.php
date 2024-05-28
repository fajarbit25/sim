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
        Schema::create('ppdbmasters', function (Blueprint $table) {
            $table->id('idpm');
            $table->string('tahun_id');
            $table->string('tahun_penerimaan');
            $table->string('gelombang');
            $table->string('status');
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
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
        Schema::dropIfExists('ppdbmasters');
    }
};
