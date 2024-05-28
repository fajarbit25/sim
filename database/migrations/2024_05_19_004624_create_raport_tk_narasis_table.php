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
        Schema::create('raport_tk_narasis', function (Blueprint $table) {
            $table->id();
            $table->longText('user_id');
            $table->longText('semester');
            $table->longText('kelas');
            $table->string('ta');
            $table->string('tanggal');
            $table->longText('fase');
            $table->text('agama');
            $table->text('jati_diri');
            $table->text('literasi');
            $table->text('refleksi_guru');
            $table->text('refleksi_orang_tua');
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
        Schema::dropIfExists('raport_tk_narasis');
    }
};
