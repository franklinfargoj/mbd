<?php

namespace App;
use App\OcEEScrutinyAnswer;

use Illuminate\Database\Eloquent\Model;

class OcSrutinyQuestionMaster extends Model
{
    protected $table = 'oc_scrutiny_question_master';

    public function ocScrutinyAnswer()
    {
        return $this->hasOne('App\OcEEScrutinyAnswer', 'question_id','id');
    }
}
