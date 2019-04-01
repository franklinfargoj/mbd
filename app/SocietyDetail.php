<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocietyDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = "lm_society_detail";
    protected $primaryKey = 'id';
    protected $fillable = [
        'colony_id',
        'society_bill_level',
        'society_name',
        'district',
        'taluka',
        'village',
        'layout_id',
        'survey_number',
        'cts_number',
        'chairman',
        'society_address',
        'area',
        'date_on_service_tax',
        'surplus_charges',
        'surplus_charges_last_date',
        'village_id',
        'other_land_id',
        'chairman_mob_no',
        'secretary',
        'secretary_mob_no',
        'society_email_id',
        'society_reg_no',
        'society_conveyed',
        'date_of_conveyance',
        'area_of_conveyance',
    ];

    public function societyVillage()
    {
        return $this->belongsTo('App\VillageDetail', 'village_id');
    }

    public function Villages()
    {
        return $this->belongsToMany('App\VillageDetail', 'village_societies', 'society_id', 'village_id');
    }

    public function building()
    {
        return $this->hasMany('App\MasterBuilding');
    }

    public function MasterColony(){

        return $this->belongsTo('App\MasterColony');    
    
    }

    public function societyLease()
    {
        return $this->hasMany('App\LeaseDetail', 'society_id')->orderBy('id','desc');
    }

    public function getDistrictName(){
        return $this->hasOne('App\District', 'id','district');

    }
    public function getTalukaName(){
        return $this->hasOne('App\Taluka', 'id','taluka');

    }
    public function getLayoutName(){
        return $this->hasOne('App\MasterLayout', 'id','layout_id');

    }

    public function getLandName(){
        return $this->hasOne('App\OtherLand', 'id','other_land_id');

    }
}
