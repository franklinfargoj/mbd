<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemainingResidentAreaToCalculationSheetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('remaining_area_of_resident_area')->after('offsite_notification_charge_as_per_notification')->nullable();
            $table->string('remaining_area_of_resident_area_rate')->after('remaining_area_of_resident_area')->nullable();
            $table->string('remaining_area_of_resident_area_balance')->after('remaining_area_of_resident_area_rate')->nullable();

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
            $table->dropColumn('remaining_area_of_resident_area');
            $table->dropColumn('remaining_area_of_resident_area_rate');
            $table->dropColumn('remaining_area_of_resident_area_balance');

        });
    }
}
