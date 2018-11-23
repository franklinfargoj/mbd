<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocSocietyDocumentsStatus extends Model
{
    protected $table = 'noc_society_document_status';
    protected $fillable = [
        'society_id',
        'document_id',
        'society_document_path',
    ];

    public function documents_uploaded(){
    	return $this->belongsTo(NocSocietyDocumentsStatus::class, 'document_id');
    } 

    public function documents_Name(){
    	return $this->hasmany('App\NocSocietyDocumentsStatus','id','document_id');
    }         
}
