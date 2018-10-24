<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterSociety extends Model
{
     protected $table = 'master_societies';

    public function building()
    {
        return $this->hasMany('App\MasterBuilding');
    }

    public function MasterColony(){

    	return $this->belongsTo('App\MasterColony');	
    
    }
}
