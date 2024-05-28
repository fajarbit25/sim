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
        Schema::create('bulan_kaldiks', function (Blueprint $table) {
            $table->id();
            $table->string('campus_id');
            $table->string('ta');
            $table->string('semester');
            $table->string('tahun');
            $table->string('bulan');
            $table->integer('he_sekolah');
            $table->integer('he_semester');
            $table->string('pe');
            $table->string('jumlah_pe');
            $table->string('lock');
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
        Schema::dropIfExists('bulan_kaldiks');
    }
};
