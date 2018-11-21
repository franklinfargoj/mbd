<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedRTIStatus extends Model
{
    protected $table    = 'deleted_rti_status_details';
    protected $fillable = [ 'rti_status_details_id',
        'user_name',
        'status_title',
        'day',
        'date',
        'time',
        'reason',
    ];
}