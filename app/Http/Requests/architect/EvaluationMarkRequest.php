<?php

namespace App\Http\Requests\architect;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationMarkRequest extends FormRequest
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
            "marks.*"  => "required|regex:/^\d*(\.\d{1,2})?$/",
            "remark.*"  => "required",
        ];
    }
}
