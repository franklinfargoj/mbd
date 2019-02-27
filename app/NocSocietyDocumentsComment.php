<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocSocietyDocumentsComment extends Model
{
    protected $table = 'noc_society_document_comment';
    protected $fillable = [
        'society_id',
        'society_documents_comment',
        'application_id'
    ];
}
