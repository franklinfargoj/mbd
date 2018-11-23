<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_request_form_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id');
            $table->date('offer_letter_date')->nullable();
            $table->string('offer_letter_number')->nullable();
            $table->decimal('demand_draft_amount')->nullable();
            $table->string('demand_draft_number')->nullable();
            $table->date('demand_draft_date')->nullable();
            $table->string('demand_draft_bank')->nullable();
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
        Schema::dropIfExists('noc_request_form_details');
    }
}
