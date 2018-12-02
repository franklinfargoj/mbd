<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplicationMaster extends Model
{
    protected $table = 'ol_application_master';

    public function ol_application_type(){
        return $this->hasMany(OlApplicationMaster::class, 'id','parent_id');
    }
}
