<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocietyConveyanceDocumentMaster extends Model
{
    protected $table = "society_conveyance_document_master";

    protected $fillable = [
        'document_name',
        'application_type_id',
        'language_id'
    ];
}
