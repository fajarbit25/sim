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
        Schema::create('kompetensi_khusus_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->enum('punya_lisensi_kepsek', ['Ya', 'Tidak'])->default('Tidak');
            $table->string('nuks')->nullable();
            $table->string('keahlian_lab')->nullable();
            $table->string('menangani_keb_khusus')->nullable();
            $table->enum('keahlian_braile', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('keahlian_bhs_isyarat', ['Ya', 'Tidak'])->default('Tidak');
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
        Schema::dropIfExists('kompetensi_khusus_teachers');
    }
};
