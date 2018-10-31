<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationImportantProjectWorkHandledDetail extends Model
{

    protected $table="eoa_application_imp_project_work_handled_details";

    protected $fillable=[
        'eoa_application_id',
        'eoa_application_imp_project_detail_id',
        'no_of_dwelling',
        'land_area_in_sq_mt',
        'built_up_area_in_sq_mt',
        'value_of_work_in_rs',
        'year_of_completion_start'
    ];
}
