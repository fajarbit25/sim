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
        Schema::create('raport_mid_tk_nilais', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('id_raport');
            $table->string('kategori');
            $table->string('subkategori');
            $table->string('materi');
            $table->string('tujuan');
            $table->string('bsb');
            $table->string('bsh');
            $table->string('mb');
            $table->string('bb');
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
        Schema::dropIfExists('raport_mid_tk_nilais');
    }
};
