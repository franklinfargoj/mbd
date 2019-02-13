<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutUser extends Model
{
    protected $table = 'layout_user';

    public function user(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
