<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_no');
            $table->string('tenant_id');
            $table->string('building_id');
            $table->string('society_id');
            $table->string('paid_by');
            $table->string('mode_of_payment');
            $table->string('bill_amount');
            $table->string('amount_paid');
            $table->string('from_date');
            $table->string('to_date');
            $table->string('balance_amount');
            $table->string('credit_amount');
             $table->softDeletes();
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
        Schema::dropIfExists('trans_payment');
    }
}
