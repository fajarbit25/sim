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
        Schema::create('absens', function (Blueprint $table) {
            $table->id('idabsen');
            $table->string('kode_absen');
            $table->string('semester');
            $table->string('kelas');
            $table->string('mapel');
            $table->string('user_id');
            $table->string('siswa_id');
            $table->string('absensi');
            $table->string('keterangan');
            $table->string('tanggal_absen');
            $table->string('status');
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
        Schema::dropIfExists('absens');
    }
};
