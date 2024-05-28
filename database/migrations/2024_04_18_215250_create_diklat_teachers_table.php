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
        Schema::create('diklat_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('jenis');
            $table->string('nama');
            $table->string('penyelenggara');
            $table->string('tahun');
            $table->string('peran');
            $table->string('tingkat');
            $table->string('berapa_jam');
            $table->string('sertifikat_diklat');
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
        Schema::dropIfExists('diklat_teachers');
    }
};
