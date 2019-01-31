<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmploymentOfArchitect\EoaApplication;

class ArchitectApplicationStatusLog extends Model
{
    protected $table = "architect_application_status_logs";

    public $timestamps=false;

    protected $fillable = [
    	'architect_application_id',
        'user_id',
        'role_id',
        'status_id',
        'to_user_id',
        'to_role_id',
        'remark',
        'changed_at'
    ];
    public function architectApplication()
    {
        return $this->belongsTo(ArchitectApplication::class);
    }

    public function eoa_application()
    {
        return $this->belongsTo(EoaApplication::class,'architect_application_id','id');
    }

    public function getCurrentRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');
    }

    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    
}
