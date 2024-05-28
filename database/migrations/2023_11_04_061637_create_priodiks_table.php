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
        Schema::create('priodiks', function (Blueprint $table) {
            $table->id('idpriodik');
            $table->string('user_id');
            $table->string('tinggi')->nullable();
            $table->string('berat')->nullable();
            $table->string('lingkar_kepala')->nullable();
            $table->string('jarak_per_1km')->nullable();
            $table->string('jarak')->nullable();
            $table->string('jam')->nullable();
            $table->string('menit')->nullable();
            $table->string('saudara')->nullable();
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
        Schema::dropIfExists('priodiks');
    }
};
