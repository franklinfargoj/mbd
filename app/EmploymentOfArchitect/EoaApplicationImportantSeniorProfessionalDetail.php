<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationImportantSeniorProfessionalDetail extends Model
{
    protected $table="eoa_application_imp_senior_professional_details";

    protected $fillable=[
        'eoa_application_id',
        'category',
        'name',
        'qualifications',
        'year_of_qualification',
        'len_of_service_with_firm_in_year',
        'len_of_service_with_firm_in_month'
    ];
}
