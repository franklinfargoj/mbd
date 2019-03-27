<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taluka extends Model
{
    protected $table = "districts";
    protected $primaryKey = 'id';
    protected $fillable = [
        'taluka_name',
        'district_id'
    ];

}
