<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDcrRateInOlApplicationCalculationSheetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_application_calculation_sheet_details', 'dcr_rate')){
                $table->string('dcr_rate')->after('redirekner_val')->nullable();                
            } 
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
            if (Schema::hasColumn('ol_application_calculation_sheet_details', 'dcr_rate')){
                $table->dropColumn('dcr_rate');                
            }
        });
    }
}
