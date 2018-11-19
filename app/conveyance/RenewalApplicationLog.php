<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalApplicationLog extends Model
{
	protected $table = 'renewal_application_log';
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
