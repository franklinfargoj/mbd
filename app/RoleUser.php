<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $table = "role_user";

    protected $fillable = [
    	'user_id',
    	'role_id',
    	'start_date',
    	'end_date'
    ];

    public $timestamps = false;
}
