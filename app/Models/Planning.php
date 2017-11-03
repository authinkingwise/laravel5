<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
	use \App\Uuids;

    protected $table = 'planning';

    protected $fillable = [
    	'user_id', 
    	'creator_id', 
    	'ticket_id', 
    	'project_id', 
    	'task_id', 
    	'description',
    	'schedule_hours',
    	'schedule_date',
    	'actual_hours',
    	'actual_date',
    	'tenant_id'
    ];

    public $incrementing = false;
}
