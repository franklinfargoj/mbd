<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hearing extends Model
{
    protected $table = "hearing";
    protected $primaryKey = 'id';
    protected $fillable = [
        'preceding_officer_name',
        'case_year',
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
        'hearing_status_id',
    ];
}
