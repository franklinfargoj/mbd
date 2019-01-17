<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiDepartmentUser extends Model
{
    protected $table="rti_department_users";


    public function master_department()
    {
        return $this->belongsTo(\App\Department::class,'department_id','id');
    }
}
