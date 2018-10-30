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
    protected $table = 'society_conveyance_document_master';

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
        ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    public function sc_document_status()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentStatus', 'conveyance_document_id','id');
    }

}
