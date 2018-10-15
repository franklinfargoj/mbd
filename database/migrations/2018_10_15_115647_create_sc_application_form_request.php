<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScApplicationFormRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_application_form_request', function (Blueprint $table){
            $table->increments('id');
            $table->integer('society_id');
            $table->string('society_name')->nullable();
            $table->string('society_no')->nullable();
            $table->string('scheme_name')->nullable();
            $table->datetime('first_flat_issue_date')->nullable();
            $table->integer('residential_flat')->nullable();
            $table->integer('non_residential_flat')->nullable();
            $table->integer('total_flat')->nullable();
            $table->string('society_registration_no')->nullable();
            $table->datetime('society_registration_date')->nullable();
            $table->integer('property_tax')->nullable();
            $table->integer('water_bil')->nullable();
            $table->integer('no_agricultural_tax')->nullable();
            $table->string('society_address')->nullable();  
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
        Schema::dropIfExists('sc_application_form_request');
    }
}
