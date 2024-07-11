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
        Schema::create('tahfidz_surahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('bahasa');
            $table->string('arab');
            $table->string('jus');
            $table->string('ayat');
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
        Schema::dropIfExists('tahfidz_surahs');
    }
};
