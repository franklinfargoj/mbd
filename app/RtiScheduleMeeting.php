<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiScheduleMeeting extends Model
{
    protected $fillable = [
    	'application_no',
    	'meeting_scheduled_date',
    	'meeting_venue',
    	'meeting_time',
    	'contact_person_name'
    ];
}
