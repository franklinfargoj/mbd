<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocietyConveyance extends Model
{
    protected $table = "sc_application_form_request";

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
        'template_file',
        'prev_lease_agreement_no'
    ];

}
