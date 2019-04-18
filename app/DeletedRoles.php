<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedRoles extends Model
{
    protected $table    = 'deleted_role_details';
    protected $fillable = [ 'role_details_id',
        'user_name',
        'role_name',
        'day',
        'date',
        'time',
        'reason',
        'ip_address'
    ];
}