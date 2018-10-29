<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationEnclosure extends Model
{
    protected $table="eoa_application_enclosures";

    protected $fillable=['id','eoa_application_id','enclosure'];
}
