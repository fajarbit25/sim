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
        Schema::create('konselings', function (Blueprint $table) {
            $table->id();
            $table->string('campus_id');
            $table->string('ta');
            $table->string('semester');
            $table->string('kelas');
            $table->string('user_id');
            $table->string('pelanggaran_id');
            $table->string('ket');
            $table->string('foto');
            $table->string('created_by');
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
        Schema::dropIfExists('konselings');
    }
};
