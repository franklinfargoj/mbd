<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlNoDueCertificateQuestionMaster extends Model
{
    protected $table = 'ol_no_due_certificate_question_master';

    //No due ceritificate deatils
    public function noDuesDetails(){
    	return $this->hasOne('App\OlNoDueCertificateDetails','question_id','id');
    }
}
