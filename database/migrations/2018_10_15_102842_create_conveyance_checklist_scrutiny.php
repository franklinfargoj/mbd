<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveyanceChecklistScrutiny extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('conveyance_checklist_scrutiny', function (Blueprint $table){
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id')->nullable();
            $table->string('home_organization_name')->nullable();
            $table->datetime('registration_date')->nullable();
            $table->string('chawl_no')->nullable();
            $table->string('colony_name')->nullable();
            $table->string('property_certificate')->nullable();
            $table->string('tenants_list')->nullable();
            $table->datetime('date')->nullable();
            $table->string('scheme_income_group')->nullable();
            $table->string('total_flat')->nullable();
            $table->datetime('first_flat_issue_date')->nullable();
            $table->string('individual_destribution')->nullable();
            $table->string('hps_installement_time')->nullable();
            $table->datetime('hps_installement_date')->nullable();
            $table->string('final_sale_price')->nullable();
            $table->string('contruction_price')->nullable();
            $table->string('land_premium')->nullable();
            $table->string('payment_completed')->nullable();
            $table->string('land_premium_completed')->nullable();
            $table->string('organization_rent_rate')->nullable();
            $table->datetime('last_date_of_rent')->nullable();
            $table->datetime('service_tax_date')->nullable();
            $table->string('service_tax_rate')->nullable();
            $table->string('work_assignment')->nullable();
            $table->string('society_area')->nullable();
            $table->string('serve_map')->nullable();
            $table->string('service_delivered')->nullable();
            $table->string('pump_house')->nullable();
            $table->string('property_tax')->nullable();
            $table->string('water_tax')->nullable();
            $table->datetime('contruction_competion_date')->nullable();
            $table->datetime('resolution_meeting_date')->nullable();
            $table->string('members_name')->nullable();
            $table->string('dyco_note')->nullable();
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
        Schema::dropIfExists('conveyance_checklist_scrutiny');
    }
}
