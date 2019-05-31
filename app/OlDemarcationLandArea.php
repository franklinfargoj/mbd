<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlDemarcationLandArea extends Model
{
    protected $table = 'ol_demarcation_land_area';
     protected $fillable = ['application_id','user_id','lease_agreement_area','tit_bit_area','rg_plot_area','pg_plot_area','road_setback_area','encroachment_area','another_area','stag_plot_area','total_area','ob_building_area','road_setback_area','encroachment_area','stag_lease_area','stag_tit_bit_area','stag_rg_plot','stag_road_setback_area','stag_encroachment_area','existing_construction_area'];
}
