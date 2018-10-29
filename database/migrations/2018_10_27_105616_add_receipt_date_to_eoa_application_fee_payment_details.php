<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReceiptDateToEoaApplicationFeePaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_application_fee_payment_details', function (Blueprint $table) {
            $table->date('receipt_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_application_fee_payment_details', function (Blueprint $table) {
            $table->dropColumn('receipt_date');
        });
    }
}
