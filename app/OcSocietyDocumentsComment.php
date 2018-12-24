<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcSocietyDocumentsComment extends Model
{
    protected $table = 'oc_society_document_comment';
    protected $fillable = [
        'society_id',
        'society_documents_comment'
    ];
}