<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VillageSociety extends Model
{
    protected $table="village_societies";


    public function getVillageDetails(){
        return $this->hasOne('App\VillageDetail', 'id','village_id');

    }
    public function getSocietyDetails(){
        return $this->hasOne('App\SocietyDetail', 'id','society_id');

    }

    public function getDistrictName(){
        return $this->hasOne('App\District', 'id','district');

    }
    public function getTalukaName(){
        return $this->hasOne('App\Taluka', 'id','taluka');

    }
}
