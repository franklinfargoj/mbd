<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadCaseJudgement extends Model
{
    protected $table = "upload_case_judgement";
    protected $primaryKey = 'id';
    protected $fillable = [
        'hearing_id',
        'upload_judgement_case',
        'description',
        'judgement_case_filename',
        'user_id'
    ];

    public function userDetails(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }     
}
