<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedVillages extends Model
{
	protected $table    = 'deleted_village_details';
    protected $fillable = [ 'village_details_id',
					        'user_name',
					        'land_name',
					        'day',
					        'date',
					        'time',
					        'change_file_name',
					        'reason',
    					  ];
}
