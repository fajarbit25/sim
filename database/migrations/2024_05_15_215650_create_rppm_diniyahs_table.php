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
        Schema::create('rppm_diniyahs', function (Blueprint $table) {
            $table->id();
            $table->string('campus_id');
            $table->string('semester');
            $table->string('bulan');
            $table->string('pekan');
            $table->string('kelompok_id');
            $table->string('topik_id');
            $table->string('subtopik_id');
            $table->string('segment_materi');
            $table->string('materi');
            $table->string('kegiatan');
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
        Schema::dropIfExists('rppm_diniyahs');
    }
};
