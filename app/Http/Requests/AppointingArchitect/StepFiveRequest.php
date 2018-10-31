<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepFiveRequest extends FormRequest
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
            'eoa_application_imp_project_detail_id.*' => 'required',
            'no_of_dwelling.*' => 'required',
            'land_area_in_sq_mt.*' => 'required',
            'built_up_area_in_sq_mt.*'=>'required',
            'value_of_work_in_rs.*'=>'required',
            'year_of_completion_start.*'=>'required'
        ];
    }
}
