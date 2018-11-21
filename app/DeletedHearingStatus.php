<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedHearingStatus extends Model
{
    protected $table    = 'deleted_hearing_status_details';
    protected $fillable = [ 'hearing_status_details_id',
        'user_name',
        'status_title',
        'day',
        'date',
        'time',
        'reason',
    ];
}