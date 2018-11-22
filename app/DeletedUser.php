<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    protected $table    = 'deleted_user_details';
    protected $fillable = [ 'user_details_id',
        'user_name',
        'email',
        'day',
        'date',
        'time',
        'reason',
    ];
}