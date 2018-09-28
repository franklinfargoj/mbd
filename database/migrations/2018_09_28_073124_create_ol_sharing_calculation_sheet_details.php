<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlSharingCalculationSheetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id');
            $table->string('area_of_tit_bit_plot')->nullable();
            $table->string('area_of_total_plot')->nullable();
            $table->string('permissible_carpet_area_coordinates')->nullable();
            $table->string('permissible_construction_area')->nullable();
            $table->string('sqm_area_per_slot')->nullable();
            $table->string('total_house')->nullable();
            $table->string('permissible_proratata_area')->nullable();
            $table->string('total_permissible_construction_area')->nullable();
            $table->string('permissible_mattress_area')->nullable();
            $table->string('revised_permissible_mattress_area')->nullable();
            $table->string('revised_increased_area_for_residential_use')->nullable();
            $table->string('total_rehabilitation_mattress_area')->nullable();
            $table->string('dcr_a_val')->nullable();
            $table->string('per_sq_km_proyerta_construction_area')->nullable();
            $table->string('total_rehabilitation_construction_area')->nullable();
            $table->string('lr_val')->nullable();
            $table->string('rc_val')->nullable();
            $table->string('lr_rc_division_val')->nullable();
            $table->string('dcr_b_val')->nullable();
            $table->string('mattress_area_for_construction_area')->nullable();
            $table->string('remaining_area')->nullable();
            $table->string('dcr_c_society_val')->nullable();
            $table->string('dcr_c_mhada_val')->nullable();
            $table->string('society_share')->nullable();
            $table->string('mhada_share')->nullable();
            $table->string('mhada_share_with_fungib')->nullable();
            $table->string('existing_construction_area')->nullable();
            $table->string('off_site_infrastructure_fee')->nullable();
            $table->string('amount_to_be_paid_to_municipal')->nullable();
            $table->string('offsite_infrastructure_charge_to_mhada')->nullable();
            $table->string('scrutiny_fee')->nullable();
            $table->string('debraj_removal_fee')->nullable();
            $table->string('layout_approval_fee')->nullable();
            $table->string('water_usage_charges')->nullable();
            $table->string('total_amount_in_rs')->nullable();
            $table->string('amount_to_b_paid_to_municipal_corporation')->nullable();
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
        Schema::dropIfExists('ol_sharing_calculation_sheet_details');
    }
}
