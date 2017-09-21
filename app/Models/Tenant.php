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
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
	public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

    /**
     * A tenant may have many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    /**
     * Ticket is owned by this tenant.
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Tenant');
    }
}
