<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoadSetbackAreaInOlDemarcationLandArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_demarcation_land_area', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_land_area', 'road_setback_area')){
                $table->string('road_setback_area')->after('total_area')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_land_area', 'encroachment_area')){
                $table->string('encroachment_area')->after('road_setback_area')->nullable();
            }
            if (!Schema::hasColumn('ol_demarcation_land_area', 'stag_lease_area')){
                $table->string('stag_lease_area')->after('encroachment_area')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_land_area', 'stag_tit_bit_area')){
                $table->string('stag_tit_bit_area')->after('stag_lease_area')->nullable(); 

            }if (!Schema::hasColumn('ol_demarcation_land_area', 'stag_rg_plot')){
                $table->string('stag_rg_plot')->after('stag_tit_bit_area')->nullable();  

            }if (!Schema::hasColumn('ol_demarcation_land_area', 'stag_road_setback_area')){
                $table->string('stag_road_setback_area')->after('stag_rg_plot')->nullable();                
            }if (!Schema::hasColumn('ol_demarcation_land_area', 'stag_encroachment_area')){
                $table->string('stag_encroachment_area')->after('stag_road_setback_area')->nullable();                
            }if (!Schema::hasColumn('ol_demarcation_land_area', 'existing_construction_area')){
                $table->string('existing_construction_area')->after('stag_encroachment_area')->nullable();                
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
        Schema::table('ol_demarcation_land_area', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_land_area', 'road_setback_area')){
                $table->dropColumn('road_setback_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'encroachment_area')){ 
                $table->dropColumn('encroachment_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'stag_lease_area')){ 
                $table->dropColumn('stag_lease_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'stag_tit_bit_area')){ 
                $table->dropColumn('stag_tit_bit_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'stag_rg_plot')){ 
                $table->dropColumn('stag_rg_plot');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'stag_road_setback_area')){
                $table->dropColumn('stag_road_setback_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'stag_encroachment_area')){
                $table->dropColumn('stag_encroachment_area');
            }
            if (Schema::hasColumn('ol_demarcation_land_area', 'existing_construction_area')){
                $table->dropColumn('existing_construction_area');
            }
        });
    }
}
