<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentFile extends Model
{
    use \App\Uuids;

    protected $table = 'comment_files';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
    	'file', 'comment_id'
    ];

    public $incrementing = false;

    public function comment()
    {
    	return $this->belongsTo('App\Models\Comment');
    }
}
