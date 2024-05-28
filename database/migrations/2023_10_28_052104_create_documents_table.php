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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('iddocs');
            $table->string('user_id');
            $table->string('akta_lahir')->nullable();
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('transkrip_nilai')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('ktp_ortu')->nullable();
            $table->string('foto')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
