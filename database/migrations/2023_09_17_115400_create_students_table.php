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
        Schema::create('students', function (Blueprint $table) {
            $table->id('idstudents');
            $table->string('user_id');
            $table->string('room_id');
            $table->string('gender')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('akta_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('negara')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('pekerjaan_pelajar')->nullable();
            $table->string('penerima_kip')->nullable();
            $table->string('no_kip')->nullable();
            $table->string('nama_kip')->nullable();
            $table->string('alasan_menolak_kip')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('penerima_kps')->nullable();
            $table->string('nomor_kps')->nullable();
            $table->string('layak_pip')->nullable();
            $table->string('alasan_layak_pip')->nullable();
            $table->string('public_token');
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
        Schema::dropIfExists('students');
    }
};
