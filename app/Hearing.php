<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hearing extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = "hearing";
    protected $primaryKey = 'id';
    protected $fillable = [
        'preceding_officer_name',
        'case_year',
        'case_number',
        'application_type_id',
        'applicant_name',
        'applicant_mobile_no',
        'applicant_address',
        'respondent_name',
        'respondent_mobile_no',
        'respondent_address',
        'case_type',
        'office_year',
        'office_number',
        'office_date',
        'office_tehsil',
        'office_village',
        'office_remark',
        'department_id',
        'board_id',
        'hearing_status_id',
    ];

    public function hearingDepartment()
    {
        return $this->hasOne('App\Department', 'id','department_id');
    }

    public function hearingBoard()
    {
        return $this->hasOne('App\Board', 'id','department_id');
    }

    public function hearingStatus()
    {
        return $this->hasOne('App\HearingStatus', 'id','hearing_status_id');
    }

    public function hearingApplicationType()
    {
        return $this->hasOne('App\ApplicationType', 'id','application_type_id');
    }

    public function hearingSchedule()
    {
        return $this->hasOne('App\HearingSchedule', 'hearing_id', 'id');
    }

    public function hearingForwardCase()
    {
        return $this->hasMany('App\ForwardCase', 'hearing_id', 'id')
                    ->orderBy('id', 'desc');
    }

    public function hearingSendNoticeToAppellant()
    {
        return $this->hasMany('App\SendNoticeToAppellant', 'hearing_id', 'id')
                    ->orderBy('id', 'desc');
    }

    public function hearingUploadCaseJudgement()
    {
        return $this->hasMany('App\UploadCaseJudgement', 'hearing_id', 'id')
                    ->orderBy('id', 'desc');
    }
}
