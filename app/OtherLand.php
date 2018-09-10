<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherLand extends Model
{
    protected $table = "other_land";
    protected $primaryKey = 'id';
    protected $fillable = [
        'land_name',
        'status'
    ];
}
