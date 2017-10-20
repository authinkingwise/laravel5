<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
    	'title', 'description', 'status_id', 'account_id', 'user_id', 'creator_id', 'last_update_user_id', 'estimated_time', 'priority_id', 'tenant_id'
    ];

    public function status()
    {
    	return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function account()
    {
    	return $this->belongsTo('App\Models\Account');
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

    public function tenant()
    {
    	return $this->belongsTo('App\Models\Tenant');
    }

    public function priority()
    {
        return $this->belongsTo('App\Models\Priority', 'priority_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'ticket_id');
    }

    public function ticketFiles()
    {
        return $this->hasMany('App\Models\TicketFile', 'ticket_id');
    }
}
