<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplication extends Model
{
    protected $table = 'ol_applications';

    public function eeApplicationSociety()
    {
        return $this->belongsTo('App\SocietyOfferLetter', 'id', 'society_id');
    }
}
