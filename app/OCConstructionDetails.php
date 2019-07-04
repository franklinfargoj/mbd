<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCConstructionDetails extends Model
{
    protected $table = 'oc_construction_details';

    protected $fillable = [
        'application_id',
        'user_id',
        'society_id',
        'floor',
        'floor_no',
        'rehab_tenements',
        'sale_tenements',
        'mhada_tenements',
        'constructed_tenements',
    ];
}
