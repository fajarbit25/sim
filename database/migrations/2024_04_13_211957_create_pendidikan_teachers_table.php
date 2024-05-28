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
        Schema::create('pendidikan_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('bidang_studi');
            $table->string('jenjang');
            $table->string('gelar_akademik');
            $table->string('satuan_pendidikan_formal');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus');
            $table->string('nim');
            $table->string('matkul');
            $table->string('semester');
            $table->string('ipk');
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
        Schema::dropIfExists('pendidikan_teachers');
    }
};
