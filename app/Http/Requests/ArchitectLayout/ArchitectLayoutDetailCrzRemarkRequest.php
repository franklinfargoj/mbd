<?php

namespace App\Http\Requests\ArchitectLayout;

use Illuminate\Foundation\Http\FormRequest;

class ArchitectLayoutDetailCrzRemarkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'dp_comment'=>'required',
             'crz_comment'=>'required',
             //'dp_remark_letter'=>'mimes:pdf',
            // 'dp_remark_plan'=>'mimes:pdf',
             'crz_remark_letter'=>'mimes:pdf',
             'crz_remark_plan'=>'mimes:pdf'
        ];
    }
}
