<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrePostSchedule extends Model
{
    protected $table = "pre_post_schedule";
    protected $primaryKey = 'id';
    protected $fillable = [
        'case_year',
        'case_number',
        'appellant_name',
        'respondent_name',
        'first_hearing_date',
        'preceding_officer_name',
        'date',
        'description',
        'pre_post_status',
        'hearing_schedule_id',
    ];
}
