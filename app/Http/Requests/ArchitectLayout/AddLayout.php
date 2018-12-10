<?php

namespace App\Http\Requests\ArchitectLayout;

use Illuminate\Foundation\Http\FormRequest;

class AddLayout extends FormRequest
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
            'layout_name' => 'required|unique:architect_layouts,layout_name',
            'layout_address' => 'required'
        ];
    }
}
