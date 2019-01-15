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

    public function rti_user()
    {
        return $this->hasOne(\App\User::class,'rti_department_users','user_id','department_id');
    }
}
