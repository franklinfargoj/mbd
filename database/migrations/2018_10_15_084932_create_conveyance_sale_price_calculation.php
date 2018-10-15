<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveyanceSalePriceCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyance_sale_price_calculation', function (Blueprint $table){
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id');
            $table->string('common_service_rate')->nullable();
            $table->string('pump_house')->nullable();
            $table->string('tenement_plinth_area')->nullable();
            $table->string('tenement_carpet_area')->nullable();
            $table->string('building_plinth_area')->nullable();
            $table->string('building_carpet_area')->nullable();
            $table->string('final_sale_price_tenement')->nullable();
            $table->datetime('completion_date')->nullable();
            $table->integer('building_no')->nullable();
            $table->string('income_group')->nullable();
            $table->string('admeasure')->nullable();
            $table->string('s_no')->nullable();
            $table->string('CTS_no')->nullable();
            $table->string('district')->nullable();
            $table->string('north_diamention')->nullable();
            $table->string('south_diamention')->nullable();
            $table->string('west_diamention')->nullable();
            $table->string('east_diamention')->nullable();
            $table->string('demarcation_map')->nullable();
            $table->string('ee_covering_letter')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conveyance_sale_price_calculation');
    }
}
