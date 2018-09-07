<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietyOfferLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_offer_letters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('society_name');
            $table->string('society_address');
            $table->string('society_building_no');
            $table->string('society_registration_no');
            $table->string('society_username');
            $table->string('society_email');
            $table->string('society_contact_no');
            $table->string('society_password');
            $table->string('society_architect_name');
            $table->string('society_architect_mobile_no');
            $table->string('society_architect_address');
            $table->string('society_architect_telephone_no');
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
        Schema::dropIfExists('society_offer_letters');
    }
}
