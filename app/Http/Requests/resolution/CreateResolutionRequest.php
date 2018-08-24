<?php

namespace App\Http\Requests\resolution;

use Illuminate\Foundation\Http\FormRequest;

class CreateResolutionRequest extends FormRequest
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
            'board_id' => 'required',
            'department_id' => 'required',
            'resolution_type_id' => 'required',
            'resolution_code' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'language' => 'required|max:255',
            'published_date' => 'required',
            'revision_log_message' => 'required',
        ];
    }
}
