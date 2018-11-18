<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalApplication extends Model
{
	protected $table = 'renewal_application';
	public $timestamps = true;

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'id','layout_id');
    }

    public function applicationLayout()
    {
        return $this->hasMany('App\MasterLayout', 'id','layout_id');
    }

    public function societyApplication()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    } 	
}
