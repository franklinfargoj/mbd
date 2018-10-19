<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scApplication extends Model
{
	protected $table = 'sc_application';
	public $timestamps = true;
	protected $fillable = [
		'society_id',
	    'form_request_id',
	    'board_id',
	    'draft_conveyance_application',
	    'stamp_conveyance_application',
	    'resolution',
	    'undertaking',
	    'sale_sub_register_name',
	    'sale_registeration_year',
	    'sale_registeration_no',
	    'lease_sub_register_name',
	    'lease_registeration_year',
	    'lease_registeration_no',
	    'service_charge_receipt',
	    'is_allotement_available',
	    'is_society_resolution',
	    'no_due_certificate',
	    'em_covering_letter',
	    'bonafide_list',
	    'riders',
	    'noc_conveyance',
	];

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'layout_id','layout_id');
    }

    public function societyApplication()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    } 

    public function societyApplicationFormRequest()
    {
        return $this->hasOne('App\SocietyConveyance', 'id','form_request_id');
    }     
    
    public function scApplicationLog()
    {
        return $this->hasOne('App\conveyance\scApplicationLog', 'application_id','id');
    }  

    public function scApplicationAgreement()
    {
        return $this->hasOne('App\conveyance\ScApplicationAgreements', 'application_id','id');
    }  

    public function ScAgreementComments()
    {
        return $this->hasOne('App\conveyance\ScAgreementComments', 'application_id','id');
    }              	
}
