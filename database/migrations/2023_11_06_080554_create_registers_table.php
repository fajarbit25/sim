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
        Schema::create('registers', function (Blueprint $table) {
            $table->id('idrg');
            $table->string('user_id');
            $table->string('kompetensi')->nullable();
            $table->string('jenis')->nullable();
            $table->string('nis')->nullable();
            $table->string('tanggal_masuk')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('npsn_sekolah')->nullable();
            $table->string('nomor_ujian')->nullable();
            $table->string('nomor_ijazah')->nullable();
            $table->string('nomor_skhu')->nullable();
            $table->string('bahasa_indonesia')->nullable();
            $table->string('matematika')->nullable();
            $table->string('ipa')->nullable();
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
        Schema::dropIfExists('registers');
    }
};
