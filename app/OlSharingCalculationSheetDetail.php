<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSharingCalculationSheetDetail extends Model
{
    protected $table = 'ol_sharing_calculation_sheet_details';
    protected $fillable = [
    'application_id',
  'user_id',
  'area_of_tit_bit_plot',
  'area_of_total_plot',
  'permissible_carpet_area_coordinates',
  'permissible_construction_area',
  'sqm_area_per_slot',
  'total_house',
  'permissible_proratata_area',
  'total_permissible_construction_area',
  'permissible_mattress_area',
  'revised_permissible_mattress_area',
  'revised_increased_area_for_residential_use',
  'total_rehabilitation_mattress_area',
  'dcr_a_val',
  'per_sq_km_proyerta_construction_area',
   'total_additional_claims',
   'total_rehabilitation_mattress_area_with_dcr',
  'total_rehabilitation_construction_area',
  'lr_val',
  'rc_val',
  'lr_rc_division_val',
  'dcr_b_val',
  'mattress_area_for_construction_area',
  'remaining_area',
  'dcr_c_society_val',
  'dcr_c_mhada_val',
  'society_share',
  'mhada_share',
  'mhada_share_with_fungib',
  'existing_construction_area',
  'off_site_infrastructure_fee',
  'amount_to_be_paid_to_municipal',
  'offsite_infrastructure_charge_to_mhada',
  'scrutiny_fee',
  'debraj_removal_fee',
  'layout_approval_fee',
  'water_usage_charges',
  'total_amount_in_rs',
  'amount_to_b_paid_to_municipal_corporation',
    ];
}
