<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public function permission()
    {
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}
