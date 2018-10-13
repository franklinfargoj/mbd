<?php

namespace App\Http\Requests\hearing;

use Illuminate\Foundation\Http\FormRequest;

class AddHearingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preceding_officer_name' => 'required',
            'case_year' => 'required',
//            'case_number' => 'required',
            'application_type_id' => 'required',
            'applicant_name' => 'required',
            'applicant_mobile_no' => 'required',
            'applicant_address' => 'required',
            'respondent_name' => 'required',
            'respondent_mobile_no' => 'required',
            'respondent_address' => 'required',
            'case_type' => 'required',
            'office_year' => 'required',
            'office_number' => 'required',
            'office_date' => 'required',
            'office_tehsil' => 'required',
            'office_village' => 'required',
            'office_remark' => 'required',
            /*'department' => 'required',
            'hearing_status_id' => 'required',*/
        ];
    }
}
