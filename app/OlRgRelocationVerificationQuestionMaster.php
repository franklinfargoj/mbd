<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlRgRelocationVerificationQuestionMaster extends Model
{
    protected $table = 'ol_rg_relocation_question_master';

    public function relocationDetails(){
        return $this->hasOne('App\OlRelocationVerificationDetails','question_id','id');
    }
}
