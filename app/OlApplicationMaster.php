<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OlApplicationMaster extends Model
{
    protected $table = 'ol_application_master';

    public function ol_application_type(){
        return $this->hasMany(OlApplicationMaster::class, 'id','parent_id');
    }

    public function ol_application_id(){
        return $this->hasMany(OlApplication::class, 'application_master_id','id');
    }

    public function noc_application_ref(){
        return $this->hasMany(NocApplication::class, 'application_master_id','id')->where('user_id', Auth::user()->id);
    }

    public function noc_cc_application_ref(){
        return $this->hasMany(NocCCApplication::class, 'application_master_id','id')->where('user_id', Auth::user()->id);
    }

    public function oc_application_ref(){
        return $this->hasMany(OcApplication::class, 'application_master_id','id')->where('user_id', Auth::user()->id);
    }
}
