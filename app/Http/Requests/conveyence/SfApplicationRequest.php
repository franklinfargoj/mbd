<?php

namespace App\Http\Requests\conveyence;

use Illuminate\Foundation\Http\FormRequest;

class SfApplicationRequest extends FormRequest
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
            'proposed_society_name'=>'required'
        ];
    }
}
