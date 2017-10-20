<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{
    use \App\Uuids;

    protected $table = 'ticket_files';

    protected $fillable = [
    	'file', 'ticket_id'
    ];

    public $incrementing = false;

    public function ticket()
    {
    	return $this->belongsTo('App\Models\Ticket');
    }
}
