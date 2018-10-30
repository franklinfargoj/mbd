<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepSevenRequest extends FormRequest
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
            'name_of_project' => 'required',
            'location' => 'required',
            'name_of_client' => 'required',
            'address'=>'required',
            'tel_no'=>'required',
            'built_up_area_in_sq_m'=>'required',
            'land_area_in_sq_m' => 'required',
            'estimated_value_of_project' => 'required',
            'completed_value_of_project' => 'required',
            'date_of_start'=>'required',
            'date_of_completion'=>'required',
            'whether_service_terminated_by_client'=>'required',
            'salient_features_of_project'=>'required',
            'reason_for_delay_if_any'=>'required'
        ];
    }
}
