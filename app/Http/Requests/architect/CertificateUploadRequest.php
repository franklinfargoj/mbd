<?php

namespace App\Http\Requests\architect;

use Illuminate\Foundation\Http\FormRequest;

class CertificateUploadRequest extends FormRequest
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
            'certificate'=>'required|mimes:doc,pdf,docx,zip'
        ];
    }
}
