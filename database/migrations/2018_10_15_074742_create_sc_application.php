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
            $table->integer('board_id')->nullable();;
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

            //sale nd lease deed agrements
            $table->string('draft_sale_agreement')->nullable();
            $table->string('draft_lease_agreement')->nullable();
            $table->string('approve_sale_agreement')->nullable();
            $table->string('approve_lease_agreement')->nullable();
            $table->string('stamp_sale_agreement')->nullable();
            $table->string('stamp_lease_agreement')->nullable();
            $table->string('sign_sale_agreement')->nullable();
            $table->string('sign_lease_agreement')->nullable();
            $table->string('register_sale_agreement')->nullable();
            $table->string('register_lease_agreement')->nullable();
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
