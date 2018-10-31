<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scApplication extends Model
{
	protected $table = 'sc_application';
	public $timestamps = true;
	protected $fillable = [
	    'sc_application_master_id',
	    'application_no',
		'society_id',
	    'form_request_id',
	    'layout_id',
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

    public function sc_form_request()
    {
        return $this->hasOne('App\SocietyConveyance', 'id','form_request_id');
    }     
    
    public function scApplicationLog()
    {
        return $this->hasOne('App\conveyance\scApplicationLog', 'application_id','id');
    }  

    public function scAgreementStatus()
    {
        return $this->hasOne('App\conveyance\ScAgreementTypeStatus', 'application_id','id');
    }  

    public function ScAgreementComments()
    {
        return $this->hasOne('App\conveyance\ScAgreementComments', 'application_id','id');
    }      
    public function ConveyanceSalePriceCalculation()
    {
        return $this->hasOne('App\conveyance\ConveyanceSalePriceCalculation', 'application_id','id');
    }

    public function scApplicationType()
    {
        return $this->hasOne('App\conveyance\scApplicationType', 'id','sc_application_master_id');
    }

}
