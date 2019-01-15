<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiAppeal extends Model
{
    protected $table="rti_appeals"; 

    protected $fillable=['application_id','user_id','role_id','created_at','updated_at'];
}
