<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocCCRequestForm extends Model
{
    protected $table = 'noc_cc_request_form_details';
    protected $fillable = [
        'society_id',
        'offer_letter_date',
        'offer_letter_number',
        'no_dues_certificate_number',
        'no_dues_certificate_date',
        'noc_no',
        'noc_date',
        'tripartite_agreement_number',
        'tripartite_agreement_date'
    ];
}
