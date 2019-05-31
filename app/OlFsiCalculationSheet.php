<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlFsiCalculationSheet extends Model
{
	protected $table = 'ol_fsi_calculation_sheet';
    protected $fillable = [
    	'application_id',
        'user_id',
        'total_no_of_buildings',
        'area_as_per_lease_agreement',
        'area_of_tit_bit_plot',
        'area_of_rg_plot',
        'area_of_ntbnib_plot',
        'area_of_total_plot',
        'area_as_per_introduction',
        'area_of_subsistence_to_calculate',
        'permissible_carpet_area_coordinates',
        'permissible_construction_area',
        'sqm_area_per_slot',
        'total_house',
        'permissible_proratata_area',
        'per_sq_km_proyerta_construction_area',
        'proratata_construction_area',
        'area_in_reserved_seats_for_vp_pio',
        'total_permissible_construction_area',
        'existing_construction_area',
        'remaining_area',
        'redirekner_value',
        'redirekner_construction_rate',
        'redirekner_val',
        'dcr_rate',
        'dcr_rate_in_percentage',
        'calculated_dcr_rate_val',
        'infrastructure_fee_amount',
        'remaining_residential_area',
        'rate_of_remaining_area',
        'balance_of_remaining_area',
        'off_site_infrastructure_fee',
        'infrastructure_charges',
        'remaining_mat_area',
        'scrutiny_fee',
        'layout_approval_fee',
        'is_water_charges_paid',
        'debraj_removal_fee',
        'is_debraj_fee_paid',
        'water_usage_charges',
        'area_of_rg_to_be_relocated',
        'total_area_of_rg_to_be_relocated',
        'groundrent_capitalization_yearly',
        'advance_groundrent_per_year',
        'nominal_groundrent',
        'total_amount_in_rs',
        'remaining_area_of_resident_area',
        'remaining_area_of_resident_area_rate',
        'remaining_area_of_resident_area_balance',
        'payment_of_first_installment',
        'payment_of_remaining_installment',
        'amount_to_be_paid_to_board',
        'basic_infrastructure_amount',
        'non_profit_duty',
        'non_profit_duty_installment',
        'non_profit_duty_val',
        'society_id',
        'calculated_commercial_dcr_rate',
        'remaining_commercial_area',
        'balance_of_commercial_remaining_area',
        'total_premium_amount','extra_construction_area','premier_construction_area','total_distributed_area','road_setback_area','encroachment_area','stag_lease_area','stag_tit_bit_area','stag_rg_plot','stag_road_setback_area','stag_encroachment_area','stag_ob_area','ob_area'
    ];    
}
