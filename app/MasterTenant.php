<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTenant extends Model
{
    protected $table = 'master_tenants';

    public function MasterBuilding(){

    	return $this->belongsTo('App\MasterBuilding');	
    
    }
}
