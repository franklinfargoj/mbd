<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepThreeRequest extends FormRequest
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
            'details_of_establishment' => 'required',
            'branch_office_details' => 'required',
            'staff_architects' => 'required',
            'staff_engineers' => 'required',
            'staff_supporting_tech' => 'required',
            'staff_supporting_nontech' => 'required',
            'staff_others' => 'required',
            'staff_total' => 'required',
            'is_cad_facility' => 'required',
            'cad_facility_no_of_computers' => 'required_if:is_cad_facility,==,1',
            'cad_facility_no_of_printers' => 'required_if:is_cad_facility,==,1',
            'cad_facility_no_of_plotters' => 'required_if:is_cad_facility,==,1',
            'cad_facility_no_of_operators'=>'required_if:is_cad_facility,==,1',
            'reg_with_council_of_architecture_principle' => 'required',
            'reg_with_council_of_architecture_associate' => 'required',
            'reg_with_council_of_architecture_partner' => 'required',
            'reg_with_council_of_architecture_coa_registration_no'=>'required',
            'reg_with_council_of_architecture_total_registered_persons' => 'required',
           // 'award_prizes_etc' => 'required',
            //'other_information' => 'required',
        ];
    }
}
