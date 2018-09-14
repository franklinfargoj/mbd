<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplication extends Model
{
    protected $table = 'ol_applications';
    protected $fillable = [
        'language_id',
        'society_id',
        'request_form_id',
        'application_master_id',
        'application_no',
        'application_path',
        'submitted_at',
        'current_status_id',
        'is_encrochment',
        'is_approve_offer_letter',
    ];

    public function eeApplicationSociety()
    {
        return $this->belongsTo('App\SocietyOfferLetter', 'id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany('App\OlApplicationStatus', 'application_id', 'id');
    }
}
