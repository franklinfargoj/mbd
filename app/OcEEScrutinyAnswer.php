<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcEEScrutinyAnswer extends Model
{
	protected $table = 'oc_scrutiny_answers';
	
    public function scrutinyQuestions(){
    	return $this->hasOne('App\OcSrutinyQuestionMaster','id','question_id');
    }    
}
