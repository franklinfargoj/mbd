<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcConstructionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oc_construction_details', function (Blueprint $table){
            $table->increments('id');
            $table->string('application_id')->nullable();
            $table->Integer('user_id')->nullable();
            $table->Integer('society_id')->nullable();
            $table->string('floor',100)->nullable();
            $table->string('floor_no',30)->nullable();
            $table->string('rehab_tenements')->nullable();
            $table->string('sale_tenements')->nullable();
            $table->string('mhada_tenements')->nullable();
            $table->string('constructed_tenements')->nullable();
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
        Schema::dropIfExists('oc_construction_details');
    }
}
