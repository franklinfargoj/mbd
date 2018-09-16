<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlConsentVerificationDetails extends Model
{
	protected $table = 'ol_consent_verification_details';
	
    public function consentQuestions(){
    	return $this->hasOne('App\OlConsentVerificationQuestionMaster','id','question_id');
    }    
}
