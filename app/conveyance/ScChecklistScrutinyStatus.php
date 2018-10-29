<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScChecklistScrutinyStatus extends Model
{
    protected $table = 'sc_checklist_scrutiny_status';
    protected $fillable = [
		'application_id',
	    'user_id',
	    'checklist_id',
	    'value',

	];
	public $timestamps = true;
}
