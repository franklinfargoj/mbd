<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scApplication extends Model
{
	protected $table = 'sc_application';
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
}
