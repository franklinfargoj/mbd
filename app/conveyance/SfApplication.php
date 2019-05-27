<?php

namespace App\conveyance;

use App\OlApplicationMaster;
use Illuminate\Database\Eloquent\Model;

class SfApplication extends Model
{
    protected $table="sf_applications";

    protected $fillable = [
        'society_id',
        'society_name',
        'proposed_society_name',
        'building_no',
        'society_address',
        'template_file'
    ];

    public function societyApplication()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    }

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'id','layout_id');
    }

    public function applicationLayout()
    {
        return $this->hasMany('App\MasterLayout', 'id','layout_id');
    }

    public function sfScrutinyByEM()
    {
        return $this->hasMany(\App\conveyance\SfScrtinyByEmMasterDetail::class, 'sf_application','id');
    }

    public function sfApplicationLog()
    {
        return $this->hasOne(\App\conveyance\SfApplicationStatusLog::class, 'application_id','id');
    }  
    
    public function scApplicationType()
    {
        return $this->hasOne('App\conveyance\scApplicationType', 'id','sc_application_master_id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany(\App\conveyance\SfApplicationStatusLog::class, 'application_id', 'id');
    }
    public function ol_application_master(){
        return $this->hasOne(\App\conveyance\scApplicationType::class, 'id', 'sc_application_master_id');
    }



}
