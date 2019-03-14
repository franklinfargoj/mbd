<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlRequestForm extends Model
{
    protected $table = 'ol_request_form_details';
    protected $fillable = [
        'society_id',
        'date_of_meeting',
        'resolution_no',
        'architect_name',
        'ol_vide_no',
        'ol_issue_date',
        'reason_for_revalidation',
        'construction_details',
        'is_full_oc',
        'offer_letter_number',
        'offer_letter_date',
        'revised_offer_letter_number',
        'revised_offer_letter_date',
        'noc_for_iod_purpose_number',
        'noc_for_iod_purpose_date',
        'developer_name',
        'noc_date',
        'noc_number'
    ];
}
