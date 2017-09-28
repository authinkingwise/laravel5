<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketActivity extends Model
{
    protected $table = 'ticket_activities';

    protected $fillable = [
		'text', 'comment_id', 'user_id', 'tenant_id'
	];

	public function comment()
    {
    	return $this->belongsTo('App\Models\Comment');
    }
}
