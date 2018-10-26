<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmSocietyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('lm_society_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('society_name')->nullable();
            $table->string('society_reg_no')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->string('village')->nullable();
            $table->string('survey_number')->nullable();
            $table->string('cts_number')->nullable();
            $table->string('chairman')->nullable();
            $table->string('chairman_mob_no')->nullable();
            $table->string('secretary')->nullable();
            $table->string('secretary_mob_no')->nullable();
            $table->string('society_address')->nullable();
            $table->string('society_email_id')->nullable();
            $table->string('area')->nullable();
            $table->string('date_on_service_tax')->nullable();
            $table->string('surplus_charges')->nullable();
            $table->string('surplus_charges_last_date')->nullable();
            $table->integer('other_land_id');
            $table->tinyInteger('society_conveyed')->nullable();
            $table->string('date_of_conveyance')->nullable();
            $table->string('area_of_conveyance')->nullable();
            $table->integer('layout_id')->nullable();
            $table->integer('colony_id')->nullable();
            $table->string('society_bill_level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('lm_society_detail', function (Blueprint $table) {
            Schema::dropIfExists('lm_society_detail');
//        });
    }
}

