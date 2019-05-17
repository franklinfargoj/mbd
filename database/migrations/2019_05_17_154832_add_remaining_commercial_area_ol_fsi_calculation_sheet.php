<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemainingCommercialAreaOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'calculated_commercial_dcr_rate')){
                $table->string('calculated_commercial_dcr_rate')->after('basic_infrastructure_amount')->nullable();                
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'remaining_commercial_area')){
                $table->string('remaining_commercial_area')->after('calculated_commercial_dcr_rate')->nullable();                
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'balance_of_commercial_remaining_area')){
                $table->string('balance_of_commercial_remaining_area')->after('remaining_commercial_area')->nullable();                
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'total_premium_amount')){
                $table->string('total_premium_amount')->after('balance_of_commercial_remaining_area')->nullable();                
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
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'calculated_commercial_dcr_rate')){
                $table->dropColumn('calculated_commercial_dcr_rate');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'remaining_commercial_area')){ $table->dropColumn('remaining_commercial_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'balance_of_commercial_remaining_area')){
                $table->dropColumn('balance_of_commercial_remaining_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'total_premium_amount')){
                $table->dropColumn('total_premium_amount');
            }
        });
    }
}
