<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlDemarcationLandArea extends Model
{
    protected $table = 'ol_demarcation_land_area';
     protected $fillable = ['application_id','user_id','lease_agreement_area','staggering_plot_area','tit_bit_area','rg_plot_area','pg_plot_area','road_setback_area','encroachment_area','another_area'];
}
