<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAreaOfSubsistenceToCalculateToCalcuationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function ($table) {
            $table->renameColumn('area_of_​​subsistence_to_calculate', 'area_of_subsistence_to_calculate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_application_calculation_sheet_details', function ($table) {
            $table->renameColumn('area_of_subsistence_to_calculate', 'area_of_​​subsistence_to_calculate');
        });
    }
}
