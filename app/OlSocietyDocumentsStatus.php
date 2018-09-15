<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlSocietyDocumentsStatus extends Model
{
    protected $table = 'ol_society_document_status';
    protected $fillable = [
        'society_id',
        'document_id',
        'society_document_path',
        'EE_document_path',
        'comment_by_EE'
    ];

    public function documents_uploaded(){
    	return $this->belongsTo(OlSocietyDocumentsStatus::class, 'document_id');
    }
    
}
