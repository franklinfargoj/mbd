<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SfApplicationStatusLog extends Model
{
    protected $table="sf_application_status_logs";

    public $timestamps = true;

    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    public function getRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');
    }
}
