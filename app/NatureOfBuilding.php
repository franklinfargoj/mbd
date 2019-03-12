<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NatureOfBuilding extends Model
{
    protected $table = 'nature_of_building';
    protected $fillable = [
        'name'
    ];
}
