<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoadSetbackAreaInOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'extra_construction_area')){
                $table->string('extra_construction_area')->after('existing_construction_area')->nullable();                
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'premier_construction_area')){
                $table->string('premier_construction_area')->after('extra_construction_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'total_distributed_area')){
                $table->string('total_distributed_area')->after('premier_construction_area')->nullable();                
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'road_setback_area')){
                $table->string('road_setback_area')->after('area_of_total_plot')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'encroachment_area')){
                $table->string('encroachment_area')->after('road_setback_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_lease_area')){
                $table->string('stag_lease_area')->after('encroachment_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_tit_bit_area')){
                $table->string('stag_tit_bit_area')->after('stag_lease_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_rg_plot')){
                $table->string('stag_rg_plot')->after('stag_tit_bit_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_road_setback_area')){
                $table->string('stag_road_setback_area')->after('stag_rg_plot')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_encroachment_area')){
                $table->string('stag_encroachment_area')->after('stag_road_setback_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_ob_area')){
                $table->string('stag_ob_area')->after('stag_encroachment_area')->nullable();
            }
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'ob_area')){
                $table->string('ob_area')->after('encroachment_area')->nullable();
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
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'extra_construction_area')){
                $table->dropColumn('extra_construction_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'premier_construction_area')){ 
                $table->dropColumn('premier_construction_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'total_distributed_area')){ 
                $table->dropColumn('total_distributed_area');
            }

            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'road_setback_area')){ $table->dropColumn('road_setback_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 
                'encroachment_area')) { $table->dropColumn('encroachment_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_lease_area')){ $table->dropColumn('stag_lease_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_tit_bit_area')){ $table->dropColumn('stag_tit_bit_area');

            }if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_rg_plot')){ 
                $table->dropColumn('stag_rg_plot');

            }if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_road_setback_area')){ 
                $table->dropColumn('stag_road_setback_area');

            }if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_encroachment_area')){ 
                $table->dropColumn('stag_encroachment_area');
            }
            
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'stag_ob_area')){ 
                $table->dropColumn('stag_ob_area');
            }
            if (Schema::hasColumn('ol_fsi_calculation_sheet', 'ob_area')){ 
                $table->dropColumn('ob_area');
            }    
        });
    }
}
