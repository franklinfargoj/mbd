<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_fsi_calculation_sheet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('total_no_of_buildings')->nullable();
            $table->string('area_as_per_lease_agreement')->nullable();
            $table->string('area_of_tit_bit_plot')->nullable();
            $table->string('area_of_rg_plot')->nullable();
            $table->string('area_of_ntbnib_plot')->nullable();
            $table->string('area_of_total_plot')->nullable();
            $table->string('area_as_per_introduction')->nullable();
            $table->string('area_of_subsistence_to_calculate')->nullable();
            $table->string('permissible_carpet_area_coordinates')->nullable();
            $table->string('permissible_construction_area')->nullable();             
            $table->string('sqm_area_per_slot')->nullable();             
            $table->string('total_house')->nullable();             
            $table->string('permissible_proratata_area')->nullable();             
            $table->string('per_sq_km_proyerta_construction_area')->nullable();             
            $table->string('proratata_construction_area')->nullable();             
            $table->string('area_in_reserved_seats_for_vp_pio')->nullable();             
            $table->string('total_permissible_construction_area')->nullable();             
            $table->string('existing_construction_area')->nullable();             
            $table->string('remaining_area')->nullable();             
            $table->string('redirekner_value')->nullable();             
            $table->string('redirekner_construction_rate')->nullable();             
            $table->string('redirekner_val')->nullable();             
            $table->integer('dcr_rate_in_percentage')->nullable();             
            $table->string('calculated_dcr_rate_val')->nullable();             
            $table->string('infrastructure_fee_amount')->nullable();             
            $table->string('remaining_residential_area')->nullable();             
            $table->string('rate_of_remaining_area')->nullable();             
            $table->string('balance_of_remaining_area')->nullable();             
            $table->string('off_site_infrastructure_fee')->nullable();             
            $table->string('infrastructure_charges')->nullable();             
            $table->string('remaining_mat_area')->nullable();             
            $table->string('scrutiny_fee')->nullable();                          
            $table->string('layout_approval_fee')->nullable();
            $table->tinyInteger('is_water_charges_paid')->default(0);
            $table->string('debraj_removal_fee')->nullable();
            $table->tinyInteger('is_debraj_fee_paid')->default(0);
            $table->string('water_usage_charges')->nullable();
            $table->string('area_of_rg_to_be_relocated')->nullable();
            $table->string('total_area_of_rg_to_be_relocated')->nullable();
            $table->string('groundrent_capitalization_yearly')->nullable();
            $table->string('advance_groundrent_per_year')->nullable();
            $table->string('nominal_groundrent')->nullable();
            $table->string('total_amount_in_rs')->nullable();
            $table->string('remaining_area_of_resident_area')->nullable();
            $table->string('remaining_area_of_resident_area_rate')->nullable();
            $table->string('remaining_area_of_resident_area_balance')->nullable();
            $table->string('payment_of_first_installment')->nullable();
            $table->string('payment_of_remaining_installment')->nullable();
            $table->string('amount_to_be_paid_to_board')->nullable();
            $table->string('basic_infrastructure_amount')->nullable();
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
       Schema::dropIfExists('ol_fsi_calculation_sheet');
    }
} 
