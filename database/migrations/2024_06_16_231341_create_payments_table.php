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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('campus_id');
            $table->string('user_id');
            $table->enum('tipe', ['IN', 'OUT']);
            $table->string('jenis');
            $table->integer('qty');
            $table->bigInteger('total_price');
            $table->bigInteger('potongan');
            $table->string('jenis_potongan')->nullable();
            $table->bigInteger('payment_fee');
            $table->enum('status', ['Paid', 'Pending', 'Unpaid']);
            $table->string('deskripsi')->nullable();
            $table->enum('check_list', ['0', '1']);
            $table->string('due_date');
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
        Schema::dropIfExists('payments');
    }
};
