<?php

namespace App;
use Validator;
use Illuminate\Database\Eloquent\Model;

class SocietyOfferLetter extends Model
{

	protected $fillable = [
        'society_name',
        'society_address',
        'society_building_no',
        'society_registration_no',
        'society_username',
        'society_email',
        'society_contact_no',
        'society_password',
        'society_architect_name',
        'society_architect_mobile_no',
        'society_architect_address',
        'society_architect_telephone_no'
    ];


    public static function validate($request){
    	$validatedata = Validator::make($request->input(), [
            'society_name' => 'required',
            'society_address' => 'required',
            'society_building_no' => 'required|alpha_num',
            'society_registration_no' => 'required|alpha_num',
            'society_username' => 'required',
            'society_email' => 'required|unique:society_offer_letters,society_email',
            'society_contact_no' => 'required|numeric',
            'society_password' => 'required',
            'society_architect_name' => 'required',
            'society_architect_mobile_no' => 'required|numeric',
            'society_architect_address' => 'required',
            'society_architect_telephone_no' => 'required',
        ]);

        return $validatedata;
    }
}
