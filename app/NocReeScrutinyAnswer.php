<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocReeScrutinyAnswer extends Model
{
	protected $table = 'noc_scrutiny_answers';
	
    public function scrutinyQuestions(){
    	return $this->hasOne('App\NocSrutinyQuestionMaster','id','question_id');
    }    
}
