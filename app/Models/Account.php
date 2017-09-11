<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'phone', 'website', 'address', 'user_id', 'tenant_id'
	];

	/**
     * An account belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * An account belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
    	return $this->belongsTo('App\Models\Account');
    }
}
