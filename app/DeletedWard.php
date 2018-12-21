<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedWard extends Model
{
    protected $table    = 'deleted_ward_details';
    protected $fillable = [ 'ward_details_id',
        'user_name',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}