<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SocietyConveyanceDocumentMaster extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_document_master';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_name',
        'application_type_id',
        'language_id',
        'society_flag',
        ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    public function sc_document_status()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentStatus', 'document_id','id');
    }

    public function sc_agreement_id()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentStatus', 'agreement_type_id','id');
    }

    public function sr_document_status()
    {
        return $this->hasOne(\App\conveyance\RenewalDocumentStatus::class, 'document_id','id');
    }
    public function sf_document_status()
    {
        return $this->hasOne(\App\conveyance\SfDocumentStatus::class, 'document_id','id');
    }

}
