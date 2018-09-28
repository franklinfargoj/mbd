<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplicationCalculationSheetDetails extends Model
{
    protected $fillable = [
        'application_id',
        'user_id',
        'total_no_of_buildings',
        'area_as_per_lease_agreement',
        'area_of_tit_bit_plot',
        'area_of_rg_plot',
        'area_of_ntbnib_plot',
        'area_as_per_introduction',
        'area_of_​​subsistence_to_calculate',
        'permissible_carpet_area_coordinates',
        'permissible_construction_area',
        'sqm_area_per_slot',
        'total_house',
        'per_sq_km_proyerta_construction_area',
        'area_in_reserved_seats_for_vp_pio',
        'total_permissible_construction_area',
        'existing_construction_area',
        'redirekner_value',
        'redirekner_construction_rate',
        'dcr_rate_in_percentage',
        'infrastructure_fee_amount',
        'remaining_residential_area',
        'rate_of_remaining_area',
        'balance_of_remaining_area',
        'off_site_infrastructure_fee',
        'amount_to_be_paid_to_municipal',
        'offsite_infrastructure_charge_to_mhada',
        'offsite_infrastructure_charges_to_municipal_corporation',
        'layout_approval_fee',
        'debraj_removal_fee',
        'water_usage_charges',
        'total_amount_in_rs',
        'offsite_notification_charge_as_per_notification',
        'remaining_area_of_resident_area',
        'remaining_area_of_resident_area_rate',
        'remaining_area_of_resident_area_balance',
        'payment_of_first_installment',
        'payment_of_remaining_installment',
        'amount_to_be_paid_to_board',
        'area_of_total_plot',
        'permissible_proratata_area',
        'proratata_construction_area',
        'remaining_area',
        'redirekner_val',
        'scrutiny_fee'
    ];
}
