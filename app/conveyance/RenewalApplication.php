<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalApplication extends Model
{
	protected $table = 'renewal_application';
	public $timestamps = true;
    protected $fillable = [
        'application_master_id',
        'application_no',
        'application_type',
        'application_status',
        'society_id',
        'form_request_id',
        'layout_id',
        'riders',
    ];

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


    public function renewalApplicationLog()
    {
        return $this->hasOne('App\conveyance\RenewalApplicationLog', 'application_id','id');
    }

    public function srApplicationLog()
    {
        return $this->hasOne('App\conveyance\RenewalApplicationLog', 'application_id','id');
    }

    public function srApplicationType()
    {
        return $this->hasOne('App\conveyance\scApplicationType', 'id','application_master_id');
    }

    public function sr_form_request()
    {
        return $this->hasOne('App\SocietyConveyance', 'id','form_request_id');
    }

    public function application_master()
    {
        return $this->hasOne('App\conveyance\scApplicationType', 'id','application_master_id');
    }

    public function ol_application_master(){
        return $this->hasOne('App\conveyance\scApplicationType', 'id','application_master_id'); 
    }

    public function olApplicationStatus(){
        return $this->hasOne('App\conveyance\RenewalApplicationLog', 'application_id','id'); 
    }

}
