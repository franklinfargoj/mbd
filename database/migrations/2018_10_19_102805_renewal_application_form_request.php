<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenewalApplicationFormRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_application_form_request', function (Blueprint $table){
            $table->increments('id');
            $table->integer('society_id');
            $table->string('society_name')->nullable();
            $table->string('society_no')->nullable();
            $table->string('scheme_name')->nullable();
            $table->datetime('first_flat_issue_date')->nullable();
            $table->string('residential_flat')->nullable();
            $table->string('non_residential_flat')->nullable();
            $table->string('total_flat')->nullable();
            $table->string('society_registration_no')->nullable();
            $table->datetime('society_registration_date')->nullable();
            $table->string('property_tax')->nullable();
            $table->string('water_bil')->nullable();
            $table->string('no_agricultural_tax')->nullable();
            $table->string('society_address')->nullable();
            $table->string('prev_lease_agreement_no')->nullable();
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
