<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlTitBitVerificationDetails extends Model
{
    protected $table = 'ol_tit_bit_details';

    public function TitBitQuestions(){
    	return $this->hasOne('App\OlTitBitVerificationQuestionMaster','id','question_id');
    }     
}
