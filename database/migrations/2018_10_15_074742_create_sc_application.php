<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_application', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id');
            $table->integer('form_request_id')->nullable();
            $table->integer('board_id')->nullable();
            $table->string('draft_conveyance_application')->nullable();
            $table->string('stamp_conveyance_application')->nullable();

            $table->string('resolution')->nullable();
            $table->string('undertaking')->nullable();

             $table->string('sale_sub_register_name')->nullable();
             $table->string('sale_registeration_year')->nullable();
             $table->string('sale_registeration_no')->nullable();

             $table->string('lease_sub_register_name')->nullable();
             $table->string('lease_registeration_year')->nullable();
             $table->string('lease_registeration_no')->nullable();             

            //uploaded by EM
            $table->string('service_charge_receipt')->nullable();
            $table->tinyInteger('is_allotement_available')->nullable();
            $table->tinyInteger('is_society_resolution')->nullable();
            $table->string('no_due_certificate')->nullable();
            $table->string('em_covering_letter')->nullable();
            $table->string('bonafide_list')->nullable();

            //LA
            $table->string('riders')->nullable();
            $table->string('noc_conveyance')->nullable();
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
        Schema::dropIfExists('sc_application');
    }
}
