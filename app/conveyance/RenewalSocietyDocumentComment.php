<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalSocietyDocumentComment extends Model
{
    protected $table = 'society_renewal_documents_comment';
    public $timestamps = true;
    protected $fillable = [
        'society_id',
        'society_documents_comment',
    ];
}
