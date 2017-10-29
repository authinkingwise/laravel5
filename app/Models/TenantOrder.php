<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantOrder extends Model
{
    protected $table = 'tenant_addresses';

    protected $fillable = [
    	'reference', 'total', 'plan', 'order_type', 'tenant_id', 'address_id'
    ];

    public $incrementing = false;

    /**
     * A tenant order may belong to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
    	return $this->belongsTo('App\Models\Tenant');
    }
}
