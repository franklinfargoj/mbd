<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSocietyDocumentsComment extends Model
{
    protected $table = 'ol_society_document_comment';
    protected $fillable = [
        'society_id',
        'society_documents_comment'
    ];
}
