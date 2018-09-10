<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandSource extends Model
{
    protected $table = "land_source";
    protected $primaryKey = 'id';
    protected $fillable = [
        'source_name',
        'status'
    ];
}
