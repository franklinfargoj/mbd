<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

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
        return $this->hasMany('App\User', 'role_id', 'id')
            ->leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'));
    }

    public function parentUserArchitect()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
