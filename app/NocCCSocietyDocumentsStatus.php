<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocCCSocietyDocumentsStatus extends Model
{
    protected $table = 'noc_cc_society_document_status';
    protected $fillable = [
        'society_id',
        'document_id',
        'society_document_path',
    ];

    public function documents_uploaded(){
    	return $this->belongsTo(NocCCSocietyDocumentsStatus::class, 'document_id');
    } 

    public function documents_Name(){
    	return $this->hasmany('App\NocCCSocietyDocumentsMaster','id','document_id');
    }         
}
