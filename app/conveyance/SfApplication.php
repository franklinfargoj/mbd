<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SfApplication extends Model
{
    protected $table="sf_applications";

    protected $fillable = [
        'society_id',
        'society_name',
        'proposed_society_name',
        'building_no',
        'society_address',
        'template_file'
    ];

    public function societyApplication()
    {
        return $this->hasOne('App\SocietyOfferLetter', 'id','society_id');
    }

    public function applicationLayoutUser()
    {
        return $this->hasMany('App\LayoutUser', 'id','layout_id');
    }

    public function applicationLayout()
    {
        return $this->hasMany('App\MasterLayout', 'id','layout_id');
    }
}
