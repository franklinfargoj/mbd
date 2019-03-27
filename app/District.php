<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts";
    protected $primaryKey = 'id';
    protected $fillable = [
        'district_name'
    ];

}
