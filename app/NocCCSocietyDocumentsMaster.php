<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocCCSocietyDocumentsMaster extends Model
{
    protected $table = 'noc_cc_society_documents_master';

    public function documents_uploaded(){
    	return $this->hasMany(NocCCSocietyDocumentsStatus::class, 'document_id', 'id');
    }
}
