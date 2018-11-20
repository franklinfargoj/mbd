<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalApplication extends Model
{
	protected $table = 'renewal_application';
	public $timestamps = true;
    protected $fillable = [
        'language_id',
        'society_id',
        'society_name',
        'society_no',
        'scheme_name',
        'first_flat_issue_date',
        'residential_flat',
        'non_residential_flat',
        'total_flat',
        'society_registration_no',
        'society_registration_date',
        'property_tax',
        'water_bill',
        'non_agricultural_tax',
        'society_address',
        'template_file'
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
}
