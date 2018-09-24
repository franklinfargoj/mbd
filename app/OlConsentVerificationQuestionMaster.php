<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlConsentVerificationQuestionMaster extends Model
{
    protected $table = 'ol_consent_verification_question_master';

    public function consentDetails(){
        return $this->hasOne('App\OlConsentVerificationDetails','question_id', 'id');
    }
}
