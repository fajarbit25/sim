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
        Schema::create('scores', function (Blueprint $table) {
            $table->id('idscore');
            $table->string('kode_score');
            $table->string('kelas');
            $table->string('mapel');
            $table->string('siswa_id');
            $table->string('nilai');
            $table->string('tanggal_penilaian');
            $table->string('bulan_penilaian');
            $table->string('grouping');
            $table->string('tag_lock');
            $table->string('tag_final');
            $table->string('user_id');
            $table->string('semester');
            $table->longText('deskripsi');
            $table->string('ta');
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
        Schema::dropIfExists('scores');
    }
};
