<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HearingSchedule extends Model
{
    protected $table = "hearing_schedule";
    protected $primaryKey = 'id';
    protected $fillable = [
        'preceding_number',
        'preceding_time',
        'preceding_date',
        'description',
        'case_template',
        'update_status',
        'update_supporting_documents',
        'hearing_id',
        'user_id'
    ];

    public function prePostSchedule()
    {
        return $this->hasMany('App\PrePostSchedule', 'hearing_schedule_id', 'id')
                    ->orderBy('id', 'desc');
    }

    public function hearing()
    {
        return $this->hasMany('App\Hearing', 'id', 'hearing_id');
    }

    public function userDetails(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function scheduledCaseJudagementDetails(){
        return $this->hasOne('App\UploadCaseJudgement', 'scheduled_hearing_id', 'id')                    ->orderBy('id', 'desc');

    }

    public function prePostCaseJudagementDetails(){
        return $this->hasOne('App\UploadCaseJudgement', 'pre_post_hearing_id', 'id');
    }
}
