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
        Schema::create('tahfidz_objects', function (Blueprint $table) {
            $table->id();
            $table->string('ta');
            $table->string('semester');
            $table->string('tingkat');
            $table->string('surah_id');
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
        Schema::dropIfExists('tahfidz_objects');
    }
};
