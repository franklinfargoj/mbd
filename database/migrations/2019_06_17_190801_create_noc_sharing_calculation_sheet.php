<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNocSharingCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_sharing_calculation_sheet', function (Blueprint $table){
            $table->increments('id');
            $table->string('application_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('society_id')->nullable();
            $table->string('area_of_tit_bit_plot')->nullable();
            $table->string('area_as_per_lease_agreement')->nullable();
            $table->string('area_of_total_plot')->nullable();
            $table->string('abhinyas_area_as_per_lease_agreement')->nullable();
            $table->string('abhinyas_area_of_tit_bit_plot')->nullable();
            $table->string('abhinyas_area_of_total_plot')->nullable();
            $table->string('area_of_​​subsistence_to_calculate')->nullable();
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
            $table->string('total_additional_claims')->nullable();
            $table->string('total_rehabilitation_mattress_area_with_dcr')->nullable();
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
            $table->string('total_no_of_buildings')->nullable();
            $table->text('tenement_charges')->nullable();
            $table->text('r_g_shiffting')->nullable();
            $table->text('ob_other_plot')->nullable();
            $table->text('vp_cota')->nullable();
            $table->text('encroachment_plot')->nullable();
            $table->text('premium_charges')->nullable();
            $table->text('tit_bit_land')->nullable();
            $table->string('ree_note')->nullable();
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
        Schema::dropIfExists('noc_sharing_calculation_sheet');
    }
}
