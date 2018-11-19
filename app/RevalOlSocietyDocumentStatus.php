<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevalOlSocietyDocumentStatus extends Model
{
    protected $table = 'reval_ol_society_document_status';

    public function documents_uploaded(){
        return $this->hasMany(RevalOlSocietyDocumentStatus::class, 'document_id', 'id');
    }

    public function documents_Name(){
        return $this->hasmany('App\OlSocietyDocumentsMaster','id','document_id');
    }
}
