<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedLayouts extends Model
{
    protected $table    = 'deleted_layout_details';
    protected $fillable = [ 'layout_details_id',
        'user_name',
        'layout_name',
        'day',
        'date',
        'time',
        'reason',
    ];
}