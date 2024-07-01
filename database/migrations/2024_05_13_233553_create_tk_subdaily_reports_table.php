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
        Schema::create('tk_subdaily_reports', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('tanggal_report');
            $table->enum('tipe', ['kegiatan', 'kata', 'foto']);
            $table->string('deskripsi');
            $table->string('updated_by');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('tk_subdaily_reports');
    }
};
