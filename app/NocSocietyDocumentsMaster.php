<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocSocietyDocumentsMaster extends Model
{
    protected $table = 'noc_society_documents_master';

    public function documents_uploaded(){
    	return $this->hasMany(NocSocietyDocumentsStatus::class, 'document_id', 'id');
    }
}
