<?php

namespace App;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SocietyOfferLetter extends Authenticatable
{
    use Notifiable;

    protected $table = "ol_societies";

    protected $primaryKey = "id";

    // protected $guard = 'society';

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
        'last_login_at',
        'user_id'
    ];


    public static function validate($request){
    	$validatedata = Validator::make($request->input(), [
            'society_name' => 'required',
            'society_address' => 'required',
            'society_contact_no' => 'required|numeric',
            'society_building_no' => 'required',
            'society_registration_no' => 'required',
            'society_architect_name' => 'required',
            'society_email' => 'required|unique:ol_societies,email|unique:users,email',
            'society_architect_mobile_no' => 'required|numeric',
            'society_architect_address' => 'required',
            'society_password' => 'required',
//            'optional_society_email' => 'unique:ol_societies,email|unique:ol_societies,optional_email|unique:users,email',
        ]);

        return $validatedata;
    }   
    
    public function societyDocuments(){
        return $this->hasMany('App\OlSocietyDocumentsStatus', 'society_id','id');
    }

    public function societyRevalDocuments(){
        return $this->hasMany('App\RevalOlSocietyDocumentStatus', 'society_id','id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withPivot('start_date', 'end_date');
    }
    public function documentComments(){

        return $this->hasOne(OlSocietyDocumentsComment::class, 'society_id', 'id');   
    } 

    public function roleUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    } 

    public function societyNocDocuments(){
        return $this->hasMany('App\NocSocietyDocumentsStatus', 'society_id','id');
    }

    public function documentCommentsNoc(){

        return $this->hasOne(NocSocietyDocumentsComment::class, 'society_id', 'id');   
    }
}
