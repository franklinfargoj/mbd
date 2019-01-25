<?php

namespace App\Http\Requests\AppointingArchitect;

use Illuminate\Foundation\Http\FormRequest;

class StepOneRequest extends FormRequest
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
            'category_of_panel' => 'required',
            'name_of_applicant' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'mobile' => 'required',
            'off' => 'required',
            //'fax' => 'required',
            'res' => 'required',
            'cash'=>'required',
            'pay_order_no'=>'required',
            'bank'=>'required',
            'branch'=>'required',
            'date_of_payment'=>'required',
            'receipt_no'=>'required',
            'receipt_date'=>'required'
        ];
    }
}
