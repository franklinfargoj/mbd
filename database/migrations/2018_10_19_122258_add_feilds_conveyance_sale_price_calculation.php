<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildsConveyanceSalePriceCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conveyance_sale_price_calculation', function (Blueprint $table) {
            $table->string('construction_cost')->after('building_carpet_area')->nullable();
            $table->string('land_premiun_infrastructure')->after('construction_cost')->nullable();
            $table->string('situated_at')->after('CTS_no')->nullable();
            $table->string('chawl_no')->after('building_no')->nullable();
            $table->string('consisting')->after('chawl_no')->nullable();
            $table->string('project_of')->after('consisting')->nullable();
            $table->string('ts_under')->after('project_of')->nullable();
        });        
       
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            $table->string('residential_flat')->nullable()->change();
            $table->string('non_residential_flat')->nullable()->change();
            $table->string('total_flat')->nullable()->change();
            $table->string('property_tax')->nullable()->change();
            $table->string('water_bil')->nullable()->change();
            $table->string('no_agricultural_tax')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conveyance_sale_price_calculation', function (Blueprint $table) {
            $table->dropColumn('construction_cost');
            $table->dropColumn('land_premiun_infrastructure');
            $table->dropColumn('situated_at');
            $table->dropColumn('chawl_no');
            $table->dropColumn('consisting');
            $table->dropColumn('project_of');
            $table->dropColumn('ts_under');
        });        
    }
}
