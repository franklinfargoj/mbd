<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlTitBitVerificationQuestionMaster extends Model
{
    protected $table = 'ol_tit_bit_question_master';

    public function titBitDetails(){
        return $this->hasOne('App\OlTitBitVerificationDetails','question_id', 'id');
    }
}
