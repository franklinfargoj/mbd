<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcSocietyDocumentStatus extends Model
{
    protected $table = 'oc_society_document_status';

    protected $fillable = [
        'society_id',
        'document_id',
        'application_id',
        'society_document_path',
    ];

    public function documents_uploaded(){
        return $this->hasMany(OcSocietyDocumentStatus::class, 'document_id', 'id');
    }

    public function documents_Name(){
        return $this->hasmany('App\OlSocietyDocumentsMaster','id','document_id');
    }
}
