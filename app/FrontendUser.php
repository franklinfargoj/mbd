<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontendUser extends Model
{
    protected $table = "frontend_users";

    protected $fillable = array('name','address','email','mobile_no');

    public function frontendUser()
    {
        return $this->hasOne('rti_form','frontend_user_id','id');
    }
}
