<?php
namespace App\Repositories;

use App\Models\Tenant;

class TenantRepository
{
	public function find($id)
	{
		$tenant = Tenant::findOrFail($id);
		return $tenant;
	}

	public function all()
	{
		$tenants = Tenant::all();
		return $tenants;
	}

	public function destroy($id)
	{
		$tenant = Tenant::findOrFail($id);
		if ($tenant->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$tenant = Tenant::findOrFail($id);
		if ($tenant->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
