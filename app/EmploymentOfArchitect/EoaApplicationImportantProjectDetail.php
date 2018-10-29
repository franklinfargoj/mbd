<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationImportantProjectDetail extends Model
{
    protected $table="eoa_application_important_project_details";

    protected $fillable=[
        'eoa_application_id',
        'name_of_client',
        'location',
        'category_of_client'
    ];
}
