<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SocietyConveyanceDocumentStatus extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_document_status';

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
        'application_id',
        'user_id',
        'society_flag',
        'status_id',
        'document_id',
        'document_path',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
