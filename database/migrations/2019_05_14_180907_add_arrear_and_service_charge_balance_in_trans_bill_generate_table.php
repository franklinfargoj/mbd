<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArrearAndServiceChargeBalanceInTransBillGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->decimal('arrear_balance',10,2)->default(0.00);
            $table->decimal('service_charge_balance',10,2)->default(0.00);
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
            $table->dropColumn('arrear_balance');
            $table->dropColumn('service_charge_balance');
        });
    }
}
