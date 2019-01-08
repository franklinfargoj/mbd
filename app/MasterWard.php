<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterWard extends Model
{
    protected $table = 'master_wards';

    protected $fillabel=['id','layout_id','name','description'];

    public function colonies()
    {
        return $this->hasMany('App\MasterColony');
    }

    public function MasterLayout(){

    	return $this->belongsTo('App\MasterLayout');	
    
    }

    public function getLayoutName()
    {
        return $this->hasOne('App\MasterLayout', 'id','layout_id');
    }

}
