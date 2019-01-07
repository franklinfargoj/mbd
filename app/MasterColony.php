<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterColony extends Model
{
    protected $table = 'master_colonies';

    protected $fillabel=['id','ward_id','name','description'];

     public function societies()
    {
        return $this->hasMany('App\SocietyDetail');
    }

    public function MasterWard(){

    	return $this->belongsTo('App\MasterWard');	
    
    }

    public function getWardName(){
        return $this->hasOne('App\MasterWard', 'id','ward_id');

    }

}
