<?php

namespace App\Http\Requests\pre_post_schedule;

use Illuminate\Foundation\Http\FormRequest;

class PrePostScheduleRequest extends FormRequest
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
            'date' => 'required',
            'description' => 'required'
        ];
    }
}
