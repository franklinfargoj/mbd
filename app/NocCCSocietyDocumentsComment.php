<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocCCSocietyDocumentsComment extends Model
{
    protected $table = 'noc_cc_society_document_comment';
    protected $fillable = [
        'application_id',
        'society_id',
        'society_documents_comment'
    ];
}
