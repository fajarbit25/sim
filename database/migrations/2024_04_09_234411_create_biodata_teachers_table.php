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
        Schema::create('biodata_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('kk')->nullable()->unique();
            $table->string('agama')->nullable();
            $table->string('npwp')->nullable()->unique();
            $table->string('nama_npwp')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('negara')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('nip_pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
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
        Schema::dropIfExists('biodata_teachers');
    }
};
