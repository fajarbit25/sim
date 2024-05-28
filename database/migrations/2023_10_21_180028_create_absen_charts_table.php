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
        Schema::create('absen_charts', function (Blueprint $table) {
            $table->id('idabsen_chart');
            $table->string('campus_id');
            $table->string('tanggal_absen');
            $table->string('hari_absen');
            $table->string('izin');
            $table->string('sakit');
            $table->String('alfa');
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
        Schema::dropIfExists('absen_charts');
    }
};
