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
        Schema::create('penugasan_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nomor_surat_tugas')->nullable();
            $table->string('tanggal_surat_tugas')->nullable();
            $table->String('tmt_tugas')->nullable();
            $table->enum('sekolah_induk', ['Ya', 'Tidak'])->default('Tidak');
            $table->string('keluar_karena')->nullable();
            $table->string('tanggal_keluar')->nullable();
            $table->string('uname_akun_ptk')->nullable();
            $table->string('pass_akun_ptk')->nullable();
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
        Schema::dropIfExists('penugasan_teachers');
    }
};
