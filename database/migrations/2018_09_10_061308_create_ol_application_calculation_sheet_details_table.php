<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlApplicationCalculationSheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id'); //processing employee id
            $table->integer('total_no_of_buildings');
            $table->string('area_as_per_lease_agreement')->nullable();
            $table->string('area_of_tit_bit_plot')->nullable();
            $table->string('area_of_rg_plot')->nullable();
            $table->string('area_of_ntbnib_plot')->nullable();
            $table->string('area_as_per_introduction')->nullable();
            $table->string('area_of_​​subsistence_to_calculate')->nullable();
            $table->string('permissible_carpet_area_coordinates')->nullable();
            $table->string('permissible_construction_area')->nullable();
            $table->string('sqm_area_per_slot')->nullable();
            $table->integer('total_house')->nullable();
            $table->string('per_sq_km_proyerta_construction_area')->nullable();
            $table->string('area_in_reserved_seats_for_vp_pio')->nullable();
            $table->string('total_permissible_construction_area')->nullable();
            $table->string('existing_construction_area')->nullable();
            $table->string('redirekner_value')->nullable();
            $table->string('redirekner_construction_rate')->nullable();
            $table->integer('dcr_rate_in_percentage')->nullable();
            $table->string('infrastructure_fee_amount')->nullable();
            $table->string('remaining_residential_area')->nullable();
            $table->string('rate_of_remaining_area')->nullable();
            $table->string('balance_of_remaining_area')->nullable();
            $table->string('off_site_infrastructure_fee')->nullable();
            $table->string('amount_to_be_paid_to_municipal')->nullable();
            $table->string('offsite_infrastructure_charge_to_mhada')->nullable();
            $table->string('offsite_infrastructure_charges_to_municipal_corporation')->nullable();
            $table->string('total_amount_in_rs')->nullable();
            $table->string('offsite_notification_charge_as_per_notification')->nullable();
            $table->string('payment_of_first_installment')->nullable();
            $table->string('payment_of_remaining_installment')->nullable();
            $table->string('amount_to_be_paid_to_board')->nullable();
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
        Schema::dropIfExists('ol_application_calculation_sheet_details');
    }
}
