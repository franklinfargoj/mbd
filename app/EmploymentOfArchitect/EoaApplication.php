<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplication extends Model
{
    protected $table="eoa_applications";

    protected $fillable=[
        'category_of_panel',
        'name_of_applicant',
        'address',
        'city',
        'pin',
        'mobile',
        'off',
        'fax',
        'res',
        'details_of_establishment',
        'branch_office_details',
        'staff_architects',
        'staff_engineers',
        'staff_supporting_tech',
        'staff_supporting_nontech',
        'staff_others',
        'staff_total',
        'is_cad_facility',
        'cad_facility_no_of_operators',
        'cad_facility_no_of_computers',
        'cad_facility_no_of_printers',
        'cad_facility_no_of_plotters',
        'reg_with_council_of_architecture_principle',
        'reg_with_council_of_architecture_associate',
        'reg_with_council_of_architecture_partner',
        'reg_with_council_of_architecture_total_registered_persons',
        'award_prizes_etc',
        'other_information',
        'application_info_and_its_enclosures_verify'
    ];
    
    public function fee_payment_details()
    {
        return $this->hasOne(\App\EmploymentOfArchitect\EoaApplicationFeePaymentDetail::class,'eoa_application_id','id');
    }

    public function enclosures()
    {
        return $this->hasMany(\App\EmploymentOfArchitect\EoaApplicationEnclosure::class,'eoa_application_id','id');
    }

    public function imp_projects()
    {
        return $this->hasMany(\App\EmploymentOfArchitect\EoaApplicationImportantProjectDetail::class,'eoa_application_id','id');
    }

    public function imp_project_work_handled()
    {
        return $this->hasMany(\App\EmploymentOfArchitect\EoaApplicationImportantProjectWorkHandledDetail::class,'eoa_application_id','id');
    }

    public function imp_senior_professionals()
    {
        return $this->hasMany(\App\EmploymentOfArchitect\EoaApplicationImportantSeniorProfessionalDetail::class,'eoa_application_id','id');
    }

    public function project_sheets()
    {
        return $this->hasMany(\App\EmploymentOfArchitect\EoaApplicationProjectSheetDetail::class,'eoa_application_id','id');
    }
}
