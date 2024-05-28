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
        Schema::create('kepegawaian_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('status')->nullable();
            $table->string('nip')->nullable();
            $table->string('niy')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('jenis_ptk')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->string('tmt_pengangkatan')->nullable();
            $table->string('lembaga_pengankat')->nullable();
            $table->string('sk_cpns')->nullable();
            $table->string('tmt_pns')->nullable();
            $table->string('golongan')->nullable();
            $table->string('sumber_gaji')->nullable();
            $table->string('kartu_pegawai')->nullable();
            $table->string('karis_karsu')->nullable();
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
        Schema::dropIfExists('kepegawaian_teachers');
    }
};
