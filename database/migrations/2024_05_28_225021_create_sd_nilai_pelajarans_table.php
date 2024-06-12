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
        Schema::create('sd_nilai_pelajarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ta');
            $table->string('semester');
            $table->string('user_id');
            $table->string('mapel_id');
            $table->string('aspek');
            $table->string('kd');
            $table->integer('nilai');
            $table->integer('non_test');
            $table->integer('test');
            $table->string('tampil');
            $table->string('tanggal_raport')->nullable();
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
        Schema::dropIfExists('sd_nilai_pelajarans');
    }
};
