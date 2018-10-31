<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepSixRequest extends FormRequest
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
            'category.*' => 'required',
            'name.*' => 'required',
            'qualifications.*' => 'required',
            'year_of_qualification.*'=>'required',
            'len_of_service_with_firm_in_year.*'=>'required',
            'len_of_service_with_firm_in_month.*'=>'required'
        ];
    }
}
