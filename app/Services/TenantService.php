<?php
namespace App\Services;

use App\Models\Tenant;

class TenantService
{
	/**
     * Check if the tenant is a paid user.
     *
     * @param  App\Models\Tenant  $tenant
     * @return boolean
     */
	public function isPremium(Tenant $tenant)
	{
		return false;
	}
}