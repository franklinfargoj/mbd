<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterWard extends Model
{
    protected $table = 'master_wards';

    public function colonies()
    {
        return $this->hasMany('App\MasterColony');
    }

    public function MasterLayout(){

    	return $this->belongsTo('App\MasterLayout');	
    
    }    

}
