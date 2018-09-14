<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplication extends Model
{
    protected $table = 'ol_applications';

    public function eeApplicationSociety()
    {
        return $this->belongsTo('App\SocietyOfferLetter', 'id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany('App\OlApplicationStatus', 'application_id', 'id');
    }
}
