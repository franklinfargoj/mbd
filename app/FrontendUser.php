<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontendUser extends Model
{
    protected $table = "frontend_users";

    public function frontendUser()
    {
        return $this->hasOne('rti_form','frontend_user_id','id');
    }
}
