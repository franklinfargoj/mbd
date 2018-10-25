<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocietyConveyanceApplicationType extends Model
{
    protected $table = "society_application_document_type";

    protected $fillable = [
        'application_type'
    ];
}
