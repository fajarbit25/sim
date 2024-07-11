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
        Schema::create('tahfidz_nilais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('campus_id');
            $table->string('ta');
            $table->string('semester');
            $table->string('kelas');
            $table->string('user_id');
            $table->string('id_surah');
            $table->integer('nilai');
            $table->string('send');
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
        Schema::dropIfExists('tahfidz_nilais');
    }
};
