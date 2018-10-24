<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServiceChargesRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_charges_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->foreign('society_id')->references('id')->on('master_societies');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('master_buildings');
            $table->year('year')->nullable();
            $table->string('tenant_type')->nullable();
            $table->decimal('water_charges',10,2)->nullable();
            $table->decimal('electric_city_charge',10,2)->nullable();
            $table->decimal('pump_man_and_repair_charges',10,2)->nullable();
            $table->decimal('external_expender_charge',10,2)->nullable();
            $table->decimal('administrative_charge',10,2)->nullable();
            $table->decimal('lease_rent',10,2)->nullable();
            $table->decimal('na_assessment',10,2)->nullable();
            $table->decimal('other',10,2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('service_charges_rates');
    }
}
