<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationProjectSheetDetail extends Model
{
    protected $table = "eoa_application_project_sheet_details";

    protected $fillable = [
        'eoa_application_id',
        'name_of_project',
        'location',
        'name_of_client',
        'address',
        'tel_no',
        'built_up_area_in_sq_m',
        'land_area_in_sq_m',
        'estimated_value_of_project',
        'completed_value_of_project',
        'date_of_start',
        'date_of_completion',
        'whether_service_terminated_by_client',
        'salient_features_of_project',
        'reason_for_delay_if_any',
        'copy_of_agreement'
    ];
}
