<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ConveyanceSalePriceCalculation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'conveyance_sale_price_calculation';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'user_id',
        'common_service_rate',
        'pump_house',
        'tenement_plinth_area',
        'tenement_carpet_area',
        'building_plinth_area',
        'building_carpet_area',
        'final_sale_price_tenement',
        'completion_date',
        'building_no',
        'income_group',
        'admeasure',
        's_no',
        'CTS_no',
        'district',
        'north_dimension',
        'south_dimension',
        'west_dimension',
        'east_dimension',
        'demarcation_map',
        'ee_covering_letter',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
