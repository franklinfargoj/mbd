<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocolApplication extends Model
{
    protected $table = 'noc_applications';
    protected $fillable = [
    	'user_id',
        'language_id',
        'society_id',
        'layout_id',
        'request_form_id',
        'application_master_id',
        'application_no',
        'application_path',
        'submitted_at',
        'current_status_id'
    ];

    public function applicationMasterLayout()
    {
        return $this->hasMany(MasterLayout::class, 'id','layout_id');
    }

    public function olApplicationStatus()
    {
        return $this->hasMany(NocApplicationStatus::class, 'application_id', 'id');
    }

    public function request_form(){
       return $this->hasOne(NocRequestForm::class, 'id', 'request_form_id');
    }

    public function ol_application_master(){
       return $this->hasOne(OlApplicationMaster::class, 'id', 'application_master_id'); 
    }
}