<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
     * The tenant owns this account. One-to-many relationship.
     */
	public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }
}
