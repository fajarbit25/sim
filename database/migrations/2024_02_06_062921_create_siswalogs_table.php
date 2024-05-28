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
        Schema::create('siswalogs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tanggal');
            $table->string('jam');
            $table->string('tipe');
            $table->string('mapel_id');
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
        Schema::dropIfExists('siswalogs');
    }
};
