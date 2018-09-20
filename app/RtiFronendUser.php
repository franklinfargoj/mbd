<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiFronendUser extends Model
{

	protected $fillable = [
        'name', 'email', 'password','mobile_no','address'
    ];

    protected $table="rti_frontend_users";
}
