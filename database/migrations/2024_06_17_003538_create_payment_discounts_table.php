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
        Schema::create('payment_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('campus_id');
            $table->string('jenis_discount');
            $table->string('deskripsi');
            $table->bigInteger('total_discount');
            $table->string('deskripsi_discount')->nullable();
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
        Schema::dropIfExists('payment_discounts');
    }
};
