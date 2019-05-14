<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlDemarcationVerificationDetails extends Model
{
    protected $table = 'ol_demarcation_details';
    protected $fillable = [
        'application_id',
        'user_id',
        'question_id',
        'answer',
        'remark',
        'floor',
        'number',
        'residential',
        'non-residential',
        'encrochment',
    ];

    public function DemarkQuestions(){ 
    	return $this->hasOne('App\OlDemarcationVerificationQuestionMaster','id','question_id');
    }    
}
