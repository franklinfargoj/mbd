<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSocietyDocumentsMaster extends Model
{
    protected $table = 'ol_society_documents_master';

    public function documents_uploaded(){
    	return $this->hasMany(OlSocietyDocumentsStatus::class, 'document_id');
    }
}
