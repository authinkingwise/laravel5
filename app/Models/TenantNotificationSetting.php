<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantNotificationSetting extends Model
{
    use \App\Uuids;

    protected $table = 'tenant_notification_settings';

    protected $fillable = [
    	'ticket_update', 'project_update', 'role_update', 'news_update', 'tenant_id'
    ];

    public $incrementing = false;

    /**
     * Tenant notification setting belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
    	return $this->belongsTo('App\Models\Tenant', 'tenant_id');
    }
}
