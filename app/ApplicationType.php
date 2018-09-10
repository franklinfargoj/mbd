<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    protected $table = "hearing_application_type";
    protected $primaryKey = 'id';
    protected $fillable = [
        'application_type'
    ];
}
