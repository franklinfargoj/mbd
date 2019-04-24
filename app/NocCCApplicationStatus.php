<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NocCCApplication;
class NocCCApplicationStatus extends Model
{
    protected $table = 'noc_cc_application_status_log';
    protected $fillable = [
    	'application_id',
        'society_flag',
        'user_id',
        'role_id',
        'status_id',
        'to_user_id',
        'to_role_id',
        'remark'
    ];

    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    public function getRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');
    }

    public function nocCCApplication()
    {
        return $this->belongsTo('App\NocCCApplication', 'application_id','id');
    }


}
