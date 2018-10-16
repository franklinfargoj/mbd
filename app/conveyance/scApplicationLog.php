<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scApplicationLog extends Model
{
	protected $table = 'sc_application_log';
	protected $fillable = [
		'application_id',
	    'society_flag',
	    'user_id',
	    'role_id',
	    'status_id',
	    'to_user_id',
	    'to_role_id',
	    'remark',
	];
}
