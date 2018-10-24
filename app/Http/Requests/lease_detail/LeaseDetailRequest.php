<?php

namespace App\Http\Requests\lease_detail;

use Illuminate\Foundation\Http\FormRequest;

class LeaseDetailRequest extends FormRequest
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
            'lease_rule_other' => "required",
            'lease_basis' => "required",
            'area' => "required",
            'lease_period' => "required",
            'lease_start_date' => "required",
            'lease_rent' => "required",
            'lease_rent_start_month' => "required",
            'interest_per_lease_agreement' => "required|numeric|max:100",
//            'lease_renewal_date' => "required",
//            'lease_renewed_period' => "required",
//            'rent_per_renewed_lease' => "required",
//            'interest_per_renewed_lease_agreement' => "required|numeric|max:100",
//            'month_rent_per_renewed_lease' => "required",
        ];
    }
}
