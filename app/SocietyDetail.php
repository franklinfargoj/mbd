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

    protected $table = "society_detail";
    protected $primaryKey = 'id';
    protected $fillable = [
        'society_name',
        'district',
        'taluka',
        'village',
        'survey_number',
        'cts_number',
        'chairman',
        'society_address',
        'area',
        'date_on_service_tax',
        'surplus_charges',
        'surplus_charges_last_date',
        'village_id',
        'other_land_id'
    ];

    public function societyVillage()
    {
        return $this->belongsTo('App\VillageDetail', 'village_id');
    }
}
