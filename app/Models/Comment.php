<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'ticket_comments';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'description', 'ticket_id', 'user_id', 'tenant_id', 'time'
	];

	/**
     * A comment belongs to a ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
    	return $this->belongsTo('App\Models\Ticket');
    }

    /**
     * A comment is created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
