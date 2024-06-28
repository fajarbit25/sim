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
        Schema::create('tahsin_catatans', function (Blueprint $table) {
            $table->id();
            $table->string('ta');
            $table->string('semester');
            $table->string('kelas');
            $table->string('user_id');
            $table->longText('catatan');
            $table->string('tanggal_rapor');
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
        Schema::dropIfExists('tahsin_catatans');
    }
};
