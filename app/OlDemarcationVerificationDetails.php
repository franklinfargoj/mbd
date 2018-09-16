<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlDemarcationVerificationDetails extends Model
{
    protected $table = 'ol_demarcation_details';

    public function DemarkQuestions(){
    	return $this->hasOne('App\OlDemarcationVerificationQuestionMaster','id','question_id');
    }    
}
