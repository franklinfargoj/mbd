<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scApplicationType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_application_master';

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
        'application_type',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
