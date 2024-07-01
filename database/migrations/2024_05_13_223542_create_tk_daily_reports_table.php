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
        Schema::create('tk_daily_reports', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('tanggal');
            $table->string('topik');
            $table->string('subtopik');
            $table->string('menghafal');
            $table->string('menulis');
            $table->string('murojaah');
            $table->string('sentra');
            $table->string('subsentra');
            $table->string('bahasa');
            $table->string('inggris');
            $table->string('arab');
            $table->string('updated_by');
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
        Schema::dropIfExists('tk_daily_reports');
    }
};
