<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScrutinyFeeToCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('scrutiny_fee')->after('offsite_infrastructure_charge_to_mhada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->dropColumn('scrutiny_fee');
        });
    }
}
