<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
	use \App\Uuids;

    protected $table = 'plannings';

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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id');
    }

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
}
