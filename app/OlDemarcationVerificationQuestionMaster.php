<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlDemarcationVerificationQuestionMaster extends Model
{
    protected $table = 'ol_demarcation_question_master';

    public function demarkDetails(){
        return $this->hasOne('App\OlDemarcationVerificationDetails','question_id','id');
    }
}
