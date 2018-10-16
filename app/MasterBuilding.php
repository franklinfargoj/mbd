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

    public function MasterSociety(){

    	return $this->belongsTo('App\MasterSociety');	
    
    }
}
