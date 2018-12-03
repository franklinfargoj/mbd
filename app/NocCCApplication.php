<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocCCApplication extends Model
{
    protected $table = 'noc_cc_applications';
    protected $fillable = [
    	'user_id',
        'language_id',
        'society_id',
        'layout_id',
        'request_form_id',
        'application_master_id',
        'application_no',
        'application_path',
        'submitted_at',
        'current_status_id'
    ];

    public function applicationMasterLayout()
    {
        return $this->hasMany(MasterLayout::class, 'id','layout_id');
    }

    public function nocApplicationStatus()
    {
        return $this->hasMany(NocCCApplicationStatus::class, 'application_id', 'id');
    }

    public function request_form(){
       return $this->hasOne(NocCCRequestForm::class, 'id', 'request_form_id');
    }

    public function noc_application_master(){
       return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id'); 
    }

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'layout_id','layout_id');
    }

    public function eeApplicationSociety()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    }

    public function nocApplicationStatusForLoginListing()
    {
        return $this->hasMany('App\NocCCApplicationStatus', 'application_id', 'id');
    }
}