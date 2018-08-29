<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HearingSchedule extends Model
{
    protected $table = "hearing_schedule";
    protected $primaryKey = 'id';
    protected $fillable = [
        'preceding_officer_name',
        'case_year',
        'case_number',
        'preceding_number',
        'appellant_name',
        'respondent_name',
        'preceding_date',
        'preceding_time',
        'description',
        'case_template',
        'update_status',
        'update_supporting_documents'
    ];
}
