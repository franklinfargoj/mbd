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
    	'remarks'
	);
}
