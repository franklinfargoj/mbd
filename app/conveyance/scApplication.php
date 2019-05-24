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

    public function sc_form_request()
    {
        return $this->hasOne('App\SocietyConveyance', 'id','form_request_id');
    }     
    
    public function scApplicationLog()
    {
        return $this->hasOne('App\conveyance\scApplicationLog', 'application_id','id');
    }  

    public function scDocumentStatus()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentStatus', 'application_id','id');
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

    public function application_master()
    {
        return $this->hasOne('App\conveyance\scApplicationType', 'id','sc_application_master_id');
    }

    public function ol_application_master(){
        return $this->hasOne('App\conveyance\scApplicationType', 'id','sc_application_master_id'); 
    }

    public function olApplicationStatus(){
        return $this->hasMany('App\conveyance\scApplicationLog', 'application_id','id'); 
    }

}
