<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NOCBuildupArea extends Model
{
    protected $table = "noc_buildup_area";
    protected $fillable = [
        'id','user_id','application_id','lease_deed_area','land_area','plot_area','fsi','buildup_area','tenement_no','tenement_area','total_tenement_area','balance_buildup_area','total_permissable_bua','total_buildup_area','noc_permitted_area','existing_buildup_area','total_existing_permitted_area'
    ];
}
