<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalApplicationLog extends Model
{

	protected $table = 'renewal_application_log';
	public $timestamps = true;

    protected $table = 'renewal_application_log';
    protected $fillable = [
        'application_id',
        'application_master_id',
        'society_flag',
        'user_id',
        'role_id',
        'status_id',
        'to_user_id',
        'to_role_id',
        'remark',
    ];


    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    public function getRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');

    }

}
