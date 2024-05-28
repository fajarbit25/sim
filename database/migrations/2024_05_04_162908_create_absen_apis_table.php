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
        Schema::create('absen_apis', function (Blueprint $table) {
            $table->id();
            $table->string('campus_id');
            $table->string('user_id');
            $table->string('tanggal');
            $table->string('tipe');
            $table->string('jam_masuk');
            $table->string('jam_pulang');
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
        Schema::dropIfExists('absen_apis');
    }
};
