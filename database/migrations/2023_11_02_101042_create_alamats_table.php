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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id('idalamat');
            $table->string('user_id')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('idprovinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('idkota')->nullable();
            $table->string('kec')->nullable();
            $table->string('idkec')->nullable();
            $table->string('kel')->nullable();
            $table->string('idkel')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('jalan')->nullable();
            $table->string('status_tempat_tinggal')->nullable();
            $table->string('moda_transportasi')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
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
        Schema::dropIfExists('alamats');
    }
};
