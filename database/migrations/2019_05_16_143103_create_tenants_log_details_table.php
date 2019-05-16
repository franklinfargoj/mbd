<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsLogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants_log_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_primary_id')->nullable();
            $table->integer('building_id')->nullable();
//            $table->foreign('building_id')->references('id')->on('master_buildings');
            $table->string('flat_no')->nullable();
            $table->string('salutation')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email_id')->nullable();
            $table->string('use')->nullable();
            $table->string('carpet_area')->nullable();
            $table->string('tenant_type')->nullable();
            $table->string('credit')->nullable();
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
        Schema::dropIfExists('tenants_log_details');
    }
}
