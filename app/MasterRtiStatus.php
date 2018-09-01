<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterRtiStatus extends Model
{
	public $table = "master_rti_status";
    protected $fillable = [
    	'status_title'
    ];
}
