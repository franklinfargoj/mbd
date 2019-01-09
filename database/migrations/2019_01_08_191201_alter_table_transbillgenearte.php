<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTransbillgenearte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->string('total_bill_after_due_date')->nullable()->after('late_fee_charge');
            $table->string('balance_amount')->nullable()->after('total_bill_after_due_date');
            $table->string('credit_amount')->nullable()->after('balance_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
