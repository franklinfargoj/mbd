<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransBillServiceCharge extends Model
{
    protected $table="trans_bill_service_charges";

    protected $fillable = [
        'trans_bill_generate_id',
        'water_charges',
        'electric_city_charge',
        'pump_man_and_repair_charges',
        'external_expender_charge',
        'administrative_charge',
        'lease_rent',
        'na_assessment',
        'property_tax',
        'other',
        'created_at',
        'updated_at'
    ];
}
