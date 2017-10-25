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
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['ticket']; // it will update the parent ticket's timestamp.

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

    public function ticketActivity()
    {
        return $this->hasOne('App\Models\TicketActivity');
    }

    public function commentFiles()
    {
        return $this->hasMany('App\Models\CommentFile', 'comment_id');
    }
}
