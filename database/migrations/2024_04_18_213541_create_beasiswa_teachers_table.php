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
        Schema::create('beasiswa_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('jenis');
            $table->string('keterangan');
            $table->string('tahun_mulai');
            $table->string('tahun_akhir');
            $table->enum('masih_menerima', ['Ya', 'Tidak', 'Tidak Dapat Dipastikan'])->default('Tidak');
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
        Schema::dropIfExists('beasiswa_teachers');
    }
};
