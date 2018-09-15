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
        'developer_name'
    ];
}
