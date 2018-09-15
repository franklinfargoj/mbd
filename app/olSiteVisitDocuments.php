<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class olSiteVisitDocuments extends Model
{
	public $timestamps = true;
    protected $table = "ol_site_visit_documents";
    protected $fillable = [
        'application_id',
        'document_path'
    ];  
}
