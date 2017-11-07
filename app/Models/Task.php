<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name', 'description', 'project_id', 'user_id', 'creator_id', 'last_update_user_id', 'schedule_id', 'due_date_time', 'order_index', 'tenant_id'
    ];

    public function project()
    {
    	return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function creator()
    {
    	return $this->belongsTo('App\User', 'creator_id');
    }

    public function lastUpdateUser()
    {
    	return $this->belongsTo('App\User', 'last_update_user_id');
    }

    public function schedule()
    {
    	return $this->belongsTo('App\Models\TaskSchedule', 'schedule_id');
    }

    public function planning()
    {
        return $this->hasOne('App\Models\Planning', 'task_id');
    }
}
