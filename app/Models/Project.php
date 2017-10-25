<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
    	'name', 'description', 'account_id', 'user_id', 'creator_id', 'status', 'visible', 'allowed_users', 'last_update_user_id', 'tenant_id'
    ];

    public function account()
    {
    	return $this->belongsTo('App\Models\Account');
    }

    /**
     * A project is assigned to a user as the project manager.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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

    /**
     * Project is visible to these users.
     *
     * @return mix, int, array
     */
    public function visibleToUsers()
    {
        if ($this->allowed_users != null) {
            $users = explode(';', $this->allowed_users);
            return $users;
        } else {
            return null;
        }
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'project_id');
    }

    public function projectFiles()
    {
        return $this->hasMany('App\Models\ProjectFile', 'project_id');
    }
}
