<?php

namespace App\Http\Requests\rti;

use Illuminate\Foundation\Http\FormRequest;

class RtiFormSubmitRequest extends FormRequest
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
            'board_id'=>"required",
            'department_id'=>"required",
            'fullname'=>"required",
            'address'=>"required",
            'info_subject'=>"required",
            'info_period_from'=>"required",
            'info_period_to'=>"required",
            'info_descr'=>"required",
            'info_post_or_person'=>"required",
            'info_post_type'=>"required_if:info_post_or_person,1",
            'applicant_below_poverty_line'=>"required",
            'poverty_line_proof_file'=>"required_if:applicant_below_poverty_line,1",
        ];
    }
}
