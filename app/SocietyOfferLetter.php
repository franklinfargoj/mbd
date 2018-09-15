<?php

namespace App;
use Validator;
use Illuminate\Database\Eloquent\Model;

class SocietyOfferLetter extends Model
{

    protected $table = "ol_societies";

	protected $fillable = [
        'language_id',
        'email',
        'password',
        'name',
        'username',
        'building_no',
        'registration_no',
        'contact_no',
        'address',
        'name_of_architect',
        'architect_mobile_no',
        'architect_telephone_no',
        'architect_address',
        'remember_token',
        'last_login_at'
    ];


    public static function validate($request){
    	$validatedata = Validator::make($request->input(), [
            'society_name' => 'required',
            'society_address' => 'required',
            'society_building_no' => 'required|alpha_num',
            'society_registration_no' => 'required|alpha_num',
            'society_username' => 'required',
            'society_email' => 'required|unique:ol_societies,email',
            'society_contact_no' => 'required|numeric',
            'society_password' => 'required',
            'society_architect_name' => 'required',
            'society_architect_mobile_no' => 'required|numeric',
            'society_architect_address' => 'required',
            'society_architect_telephone_no' => 'required',
        ]);

        return $validatedata;
    }   
    
    public function societyDocuments(){
        return $this->hasMany('App\OlSocietyDocumentsStatus', 'society_id','id');
    }        
}
