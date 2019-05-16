<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrevArrearBalanceAndPreveiousServiceChargeInTransBillGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->decimal('prev_arrear_balance',10,2)->default(0.00);
            $table->decimal('prev_service_charge_balance',10,2)->default(0.00);
            $table->decimal('prev_credit',10,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->dropColumn('prev_arrear_balance',10,2);
            $table->dropColumn('prev_service_charge_balance',10,2);
            $table->dropColumn('prev_credit',10,2);
        });
    }
}
