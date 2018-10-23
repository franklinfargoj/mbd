<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentOfArchitectApplicationFeePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_application_fee_payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eoa_application_id');
            $table->string('receipt_no')->nullable();
            $table->string('cash')->nullable();
            $table->string('pay_order_no')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->date('date_of_payment')->nullable();
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
        Schema::dropIfExists('eoa_application_fee_payment_details');
    }
}
