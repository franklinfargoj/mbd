<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNocBuildupArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_buildup_area', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('application_id')->nullable();
            $table->string('lease_deed_area')->nullable();
            $table->string('land_area')->nullable();
            $table->string('plot_area')->nullable();
            $table->string('fsi')->nullable();
            $table->string('buildup_area')->nullable();
            $table->string('tenement_no')->nullable();
            $table->string('tenement_area')->nullable();
            $table->string('total_tenement_area')->nullable();
            $table->string('balance_buildup_area')->nullable();
            $table->string('total_permissable_bua')->nullable();
            $table->string('total_buildup_area')->nullable();
            $table->string('noc_permitted_area')->nullable();
            $table->string('existing_buildup_area')->nullable();
            $table->string('total_existing_permitted_area')->nullable();
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
        Schema::dropIfExists('noc_buildup_area');
    }
}
