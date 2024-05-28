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
        Schema::create('campus', function (Blueprint $table) {
            $table->id('idcampus');
            $table->string('npsn')->nullable();
            $table->string('status')->nullable();
            $table->string('bentuk_pendidikan')->nullable();
            $table->string('kepemilikan')->nullable();
            $table->string('sk_pendirian')->nullable();
            $table->string('tanggal_sk')->nullable();
            $table->string('sk_izin_operasi')->nullable();
            $table->string('tanggal_sk_izin_operasi')->nullable();
            $table->string('campus_name');
            $table->string('campus_initial');
            $table->string('campus_tingkat');
            $table->string('campus_contact');
            $table->string('email_campus');
            $table->string('campus_kepsek');
            $table->string('campus_alamat');
            $table->string('yt');
            $table->string('fb');
            $table->string('ig');
            $table->string('tele');
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
        Schema::dropIfExists('campus');
    }
};
