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
        'developer_name',
        'ol_vide_no',
        'ol_issue_date',
        'reason_for_revalidation',
        'construction_details',
        'is_full_oc'
    ];
}
