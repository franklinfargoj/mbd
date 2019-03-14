<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcApplication extends Model
{
    protected $table = 'oc_applications';

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
        'current_status_id',
        'name_of_architect' ,
        'architect_mobile_no' ,
        'architect_telephone_no' ,
        'architect_address' ,
        'date_of_site_visit' ,
        'site_visit_officers' ,
        'oc_path' ,
        'is_approve_oc',
        'drafted_oc' ,
        'text_oc' ,
        'oc_type' ,
    ];

    public function request_form(){
        return $this->hasOne(OlRequestForm::class, 'id', 'request_form_id');
    }

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'layout_id','layout_id');
    }

    public function applicationMasterLayout()
    {
        return $this->hasMany(MasterLayout::class, 'id','layout_id');
    }

    public function ocApplicationStatus()
    {
        return $this->hasMany(OcApplicationStatusLog::class, 'application_id', 'id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany(OcApplicationStatusLog::class, 'application_id', 'id');
    }

    public function ocApplicationStatusForLoginListing()
    {
        return $this->hasMany('App\OcApplicationStatusLog', 'application_id', 'id');
    }

    public function oc_application_master(){
        return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id');
    }


    public function ol_application_master(){
        return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id');
    }

    public function application_master(){
        return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id');
    }

    public function oc_application_status(){
        return $this->hasOne(OcApplicationStatusLog::class, 'id', 'current_status_id');
    }


    public function eeApplicationSociety()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    }

}
