<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcEEScrutinyAnswer extends Model
{
	protected $table = 'oc_scrutiny_answers';
	protected $fillable = [
        'application_id',
        'society_id',
        'user_id',
        'question_id',
        'answer',
        'document_path',
        'remark',
    ];
	
    public function scrutinyQuestions(){
    	return $this->hasOne('App\OcSrutinyQuestionMaster','id','question_id');
    }    
}
