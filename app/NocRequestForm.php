<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocRequestForm extends Model
{
    protected $table = 'noc_request_form_details';
    protected $fillable = [
        'society_id',
        'offer_letter_date',
        'offer_letter_number',
        'demand_draft_amount',
        'demand_draft_number',
        'demand_draft_date',
        'demand_draft_bank',
        'offsite_infra_charges',
        'offsite_infra_receipt',
        'offsite_infra_charges_receipt_date',
        'water_charges_amount',
        'water_charges_receipt_number'
    ];
}
