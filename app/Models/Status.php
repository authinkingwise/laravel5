<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'ticket_statuses';
	
	protected $fillable = ['name', 'short_name'];
}
