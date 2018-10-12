<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCalculatedDcrValToCalcuationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('calculated_dcr_rate_val')->nullable()->after('dcr_rate_in_percentage');
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
            $table->dropColumn('calculated_dcr_rate_val');
        });
    }
}
