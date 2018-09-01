<?php

namespace App\Http\Requests\society_detail;

use Illuminate\Foundation\Http\FormRequest;

class SocietyDetailRequest extends FormRequest
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
            'society_name' => "required",
            'district' => "required",
            'taluka' => "required",
            'survey_number' => "required",
            'cts_number' => "required",
            'chairman' => "required",
            'society_address' => "required",
            'area' => "required",
            'date_on_service_tax' => "required",
            'surplus_charges' => "required",
            'surplus_charges_last_date' => "required",
            'other_land_id => "required"'
        ];
    }
}
