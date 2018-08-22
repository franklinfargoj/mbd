<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardDepartment extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
    	'board_id',
    	'department_id'
    ];
}
