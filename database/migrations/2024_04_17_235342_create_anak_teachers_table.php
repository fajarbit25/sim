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
        Schema::create('anak_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nama');
            $table->string('status');
            $table->string('jenjang_pendidikan');
            $table->string('nisn');
            $table->string('gender');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('tahun_masuk');
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
        Schema::dropIfExists('anak_teachers');
    }
};
