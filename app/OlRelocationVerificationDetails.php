<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlRelocationVerificationDetails extends Model
{
    protected $table = 'ol_rg_relocation_details';

    public function relocationQuestions(){
    	return $this->hasOne('App\OlRgRelocationVerificationQuestionMaster','id','question_id');
    }    
}
