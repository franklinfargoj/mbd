<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $primaryKey = 'id';
    protected $fillable = [
    	'department_name',
    	'status'
    ];

    public function boardDepartments()
    {
        return $this->hasMany('App\BoardDepartment');
    }
}
