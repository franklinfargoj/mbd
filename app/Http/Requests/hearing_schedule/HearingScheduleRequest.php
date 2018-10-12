<?php

namespace App\Http\Requests\hearing_schedule;

use Illuminate\Foundation\Http\FormRequest;

class HearingScheduleRequest extends FormRequest
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
            'preceding_number' => 'required',
            'preceding_date' => 'required',
            'preceding_time' => 'required',
            'description' => 'required',
//            'update_status' => 'required',
//            'file.*' => 'required|mimes:pdf',
        ];
    }
}
