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
        Schema::create('tahsin_nilais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ta');
            $table->string('semester');
            $table->string('kelas');
            $table->string('user_id');
            $table->integer('nilai');
            $table->string('kd_id');
            $table->string('jenis_penilaian');
            $table->string('campus_id');
            $table->string('tanggal_raport');
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
        Schema::dropIfExists('tahsin_nilais');
    }
};
