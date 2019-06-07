<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSocietyDocumentsStatus extends Model
{
    protected $table = 'ol_society_document_status';
    protected $fillable = [
        'society_id',
        'application_id',
        'document_id',
        'society_document_path',
        'EE_document_path',
        'comment_by_EE',
        'deleted_comment_by_EE',
        'document_name'
    ];

    public function documents_uploaded(){
    	return $this->belongsTo(OlSocietyDocumentsStatus::class, 'document_id');
    } 

    public function documents_Name(){
    	return $this->hasmany('App\OlSocietyDocumentsMaster','id','document_id');
    }

    public function document_name(){
        return $this->hasOne('App\OlSocietyDocumentsMaster','id','document_id');
    }
}
