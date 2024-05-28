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
        Schema::create('buku_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('judul');
            $table->string('tahun');
            $table->string('penerbit');
            $table->string('isbn');
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
        Schema::dropIfExists('buku_teachers');
    }
};
