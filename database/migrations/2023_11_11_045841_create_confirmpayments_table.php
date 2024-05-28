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
        Schema::create('confirmpayments', function (Blueprint $table) {
            $table->id('idcp');
            $table->string('invoice_id');
            $table->string('amount');
            $table->string('name');
            $table->string('account_id');
            $table->string('bank_name');
            $table->string('confirm_status');
            $table->string('confirm_by')->nullable();
            $table->string('evidence');
            $table->string('campus_id');
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
        Schema::dropIfExists('confirmpayments');
    }
};
