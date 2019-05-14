<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObBuildingAreaInOlDemarcationLandArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_demarcation_land_area', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_land_area', 'ob_building_area')){
                $table->string('ob_building_area')->after('encroachment_area')->nullable();                
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
            if (Schema::hasColumn('ol_demarcation_land_area', 'ob_building_area')){
                $table->dropColumn('ob_building_area');                
            }
        });
    }
}
