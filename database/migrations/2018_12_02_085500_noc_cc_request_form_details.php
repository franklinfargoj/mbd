<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocCcRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_cc_request_form_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id');
            $table->date('offer_letter_date')->nullable();
            $table->string('offer_letter_number')->nullable();
            $table->date('no_dues_certificate_date')->nullable();
            $table->string('no_dues_certificate_number')->nullable();
            $table->date('noc_date')->nullable();
            $table->string('noc_no')->nullable();
            $table->date('tripartite_agreement_date')->nullable();
            $table->string('tripartite_agreement_number')->nullable();
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
        Schema::dropIfExists('noc_cc_request_form_details');
    }
}
