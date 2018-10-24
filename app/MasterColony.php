<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterColony extends Model
{
    protected $table = 'master_colonies';

     public function societies()
    {
        return $this->hasMany('App\MasterSociety');
    }

    public function MasterWard(){

    	return $this->belongsTo('App\MasterWard');	
    
    }
}
