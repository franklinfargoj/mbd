<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBuilding extends Model
{
     protected $table = 'master_buildings';

     public function tenants()
    {
        return $this->hasMany('App\MasterTenant','building_id');
    }

    public function tenant_count(){
    	return $this->hasMany('App\MasterTenant', 'building_id')->selectRaw('building_id, count(*) as count')->groupBy('building_id');
    }

    public function MasterSociety(){

    	return $this->belongsTo('App\MasterSociety');	
    
    }
}
