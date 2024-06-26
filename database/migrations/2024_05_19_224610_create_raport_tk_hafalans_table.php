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
        Schema::create('raport_tk_hafalans', function (Blueprint $table) {
            $table->id();
            $table->string('id_narasi');
            $table->string('user_id');
            $table->string('materi');
            $table->string('kegiatan');
            $table->string('nilai');
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
        Schema::dropIfExists('raport_tk_hafalans');
    }
};
