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

    public function parent()
    {
        return $this->belongsTo('App\Role', 'parent_id', 'id');
    }

    public function child()
    {
        return $this->belongsTo('App\Role', 'id', 'parent_id');
    }

    public function parentUser()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
