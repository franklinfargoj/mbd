<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSocietyDocumentsStatus extends Model
{
    protected $table = 'ol_society_document_status';

    public function documents_uploaded(){
    	return $this->belongsTo(OlSocietyDocumentsStatus::class, 'document_id');
    }
    
}
