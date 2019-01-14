<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiForwardApplication extends Model
{
    protected $table = "rti_forward_application";

    protected $fillable = array(
    	'application_id',
    	'board_id',
    	'department_id',
		'remarks',
		'to_role_id',
		'to_user_id',
		'role_id',
		'user_id',
		'status_id'
	);
}
