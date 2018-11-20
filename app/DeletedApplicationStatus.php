<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedApplicationStatus extends Model
{
    protected $table    = 'deleted_application_status_details';
    protected $fillable = [ 'application_status_details_id',
        'user_name',
        'status_name',
        'day',
        'date',
        'time',
        'reason',
    ];
}