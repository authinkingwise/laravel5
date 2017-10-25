<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use \App\Uuids;

    protected $table = 'project_files';

    protected $fillable = [
    	'file', 'project_id'
    ];

    public $incrementing = false;

    public function project()
    {
    	return $this->belongsTo('App\Models\Project');
    }
}
