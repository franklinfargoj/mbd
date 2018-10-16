<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArrearsChargesRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrears_charges_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->foreign('society_id')->references('id')->on('master_societies');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('master_buildings');
            $table->year('year')->nullable();
            $table->string('tenant_type')->nullable();
            $table->decimal('old_rate',10,2)->nullable();
            $table->decimal('revise_rate',10,2)->nullable();
            $table->decimal('interest_on_old_rate',10,2)->nullable();
            $table->decimal('interest_on_differance',10,2)->nullable();
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
        Schema::dropIfExists('arrears_charges_rates');
    }
}
