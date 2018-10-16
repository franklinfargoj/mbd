<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ConveyanceChecklistScrutiny extends Model
{
	protected $table = 'conveyance_checklist_scrutiny';
	protected $fillable = [
		'application_id',
	    'user_id',
	    'home_organization_name',
	    'registration_date',
	    'chawl_no',
	    'colony_name',
	    'property_certificate',
	    'tenants_list',
	    'date',
	    'scheme_income_group',
	    'total_flat',
	    'first_flat_issue_date',
	    'individual_destribution',
	    'flat_delivery_method',
	    'hps_installement_time',
	    'hps_installement_date',
	    'final_sale_price',
	    'contruction_price',
	    'land_premium',
	    'payment_completed',
	    'land_premium_completed',
	    'organization_rent_rate',
	    'last_date_of_rent',
	    'service_tax_date',
	    'service_tax_rate',
	    'work_assignment',
	    'society_area',
	    'serve_map',
	    'service_delivered',
	    'pump_house',
	    'property_tax',
	    'water_tax',
	    'contruction_competion_date',
	    'resolution_meeting_date',
	    'members_name',
	    'dyco_note',
	];
}
