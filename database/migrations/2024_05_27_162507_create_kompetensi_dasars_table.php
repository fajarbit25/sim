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
        Schema::create('kompetensi_dasars', function (Blueprint $table) {
            $table->id();
            $table->string('idmapel');
            $table->string('kelas');
            $table->string('aspek');
            $table->string('kode');
            $table->string('deskripsi');
            $table->string('campus_id');
            $table->string('campus_id');
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
        Schema::dropIfExists('kompetensi_dasars');
    }
};
