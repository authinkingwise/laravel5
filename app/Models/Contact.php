<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
    	'firstname', 'lastname', 'email', 'mobile', 'account_id', 'tenant_id'
    ];

    /**
     * A contact belongs to a account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
    	return $this->belongsTo('App\Models\Account');
    }

    /**
     * A contact belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
    	return $this->belongsTo('App\Models\Tenant');
    }
}
