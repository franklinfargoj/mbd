<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplication extends Model
{
    protected $table = 'ol_applications';
    protected $fillable = [
        'language_id',
        'society_id',
        'request_form_id',
        'application_master_id',
        'application_no',
        'application_path',
        'submitted_at',
        'current_status_id',
        'is_encrochment',
        'is_approve_offer_letter',
        'demarkation_verification_comment',
        'encrochment_verification_comment',
        'date_of_site_visit',
        'site_visit_officers',
    ];

    public function eeApplicationSociety()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany('App\OlApplicationStatus', 'application_id', 'id');
    }

    public function visitDocuments(){
       return $this->hasMany('App\olSiteVisitDocuments', 'id','application_id'); 
    }

    public function request_form(){
       return $this->hasOne(OlRequestForm::class, 'id'); 
    }

    public function ol_application_master(){
       return $this->hasOne(OlApplicationMaster::class, 'id'); 
    }
}
