<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantAddress extends Model
{
    use \App\Uuids;
    
    protected $table = 'tenant_addresses';

    protected $fillable = [
    	'company', 'address', 'city', 'state', 'postcode', 'country', 'tenant_id'
    ];

    public $incrementing = false;

    /**
     * A tenant address belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
    	return $this->belongsTo('App\Models\Tenant');
    }
}
