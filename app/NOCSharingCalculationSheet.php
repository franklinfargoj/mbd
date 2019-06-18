<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NOCSharingCalculationSheet extends Model
{
    protected $table = "noc_sharing_calculation_sheet";
    protected $fillable = [
        'id','user_id','application_id','society_id','area_of_tit_bit_plot','area_as_per_lease_agreement','area_of_total_plot','abhinyas_area_as_per_lease_agreement','abhinyas_area_of_tit_bit_plot','abhinyas_area_of_total_plot','area_of_​​subsistence_to_calculate','permissible_carpet_area_coordinates','permissible_construction_area','sqm_area_per_slot','total_house','permissible_proratata_area','total_permissible_construction_area','permissible_mattress_area','revised_permissible_mattress_area','revised_increased_area_for_residential_use','total_rehabilitation_mattress_area','dcr_a_val','per_sq_km_proyerta_construction_area','total_additional_claims','total_rehabilitation_mattress_area_with_dcr','total_rehabilitation_construction_area','lr_val','rc_val','lr_rc_division_val','dcr_b_val','mattress_area_for_construction_area','remaining_area','dcr_c_society_val','dcr_c_mhada_val','society_share','mhada_share','mhada_share_with_fungib','existing_construction_area','off_site_infrastructure_fee','amount_to_be_paid_to_municipal','offsite_infrastructure_charge_to_mhada','scrutiny_fee','debraj_removal_fee','layout_approval_fee','water_usage_charges','total_amount_in_rs','amount_to_b_paid_to_municipal_corporation','total_no_of_buildings','tenement_charges','r_g_shiffting','ob_other_plot','vp_cota','encroachment_plot','premium_charges','tit_bit_land','ree_note'
    ];
}
