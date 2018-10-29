<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScChecklistMaster extends Model
{
    protected $table = 'sc_checklist_master';

    protected $fillable = [
        'language_id',
        'type_id',
        'name',
        'is_date',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */ 
    public $timestamps = true;

    public function checklistStatus(){

        return $this->hasOne('App\conveyance\ScChecklistScrutinyStatus', 'checklist_id', 'id');
    }
}
