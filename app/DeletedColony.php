<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedColony extends Model
{
    protected $table    = 'deleted_colony_details';
    protected $fillable = [ 'colony_details_id',
        'user_name',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}