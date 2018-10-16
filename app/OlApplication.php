<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplication extends Model
{
    protected $table = 'ol_applications';
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
        return $this->hasMany(OlApplicationStatus::class, 'application_id', 'id');
    }

    public function olApplicationStatusForLoginListing()
    {
        return $this->hasMany('App\OlApplicationStatus', 'application_id', 'id');
    }

    public function visitDocuments(){
       return $this->hasMany('App\olSiteVisitDocuments', 'application_id','id'); 
    }

    public function request_form(){
       return $this->hasOne(OlRequestForm::class, 'id', 'request_form_id');
    }

    public function ol_application_master(){
       return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id'); 
    }

    public function ol_application_status(){
       return $this->hasOne(OlApplicationStatus::class, 'id', 'current_status_id'); 
    }

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'layout_id','layout_id');
    }

    public function applicationMasterLayout()
    {
        return $this->hasMany(MasterLayout::class, 'id','layout_id');
    }

    public function cap_notes()
    {
        return $this->hasOne(OlCapNotes::class,'application_id','id');
    }

    public function premiumCalculationSheet(){

        return $this->hasOne(OlApplicationCalculationSheetDetails::class, 'application_id', 'id');   
    }

    public function sharingCalculationSheet(){

        return $this->hasOne(OlSharingCalculationSheetDetail::class, 'application_id', 'id');   
    }    
}
