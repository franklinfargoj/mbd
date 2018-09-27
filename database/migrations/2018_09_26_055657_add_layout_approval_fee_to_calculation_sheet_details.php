<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutApprovalFeeToCalculationSheetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('layout_approval_fee')->after('offsite_infrastructure_charges_to_municipal_corporation')->nullable();
            $table->string('debraj_removal_fee')->after('layout_approval_fee')->nullable();
            $table->string('water_usage_charges')->after('debraj_removal_fee')->nullable();
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
            $table->dropColumn('layout_approval_fee');
            $table->dropColumn('debraj_removal_fee');
            $table->dropColumn('water_usage_charges');

        });
    }
}
