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
        'society_email_id',
    ];

    public function societyVillage()
    {
        return $this->belongsTo('App\VillageDetail', 'village_id');
    }

    public function Villages()
    {
        return $this->belongsToMany('App\VillageDetail', 'village_societies', 'society_id', 'village_id');
    }
}
