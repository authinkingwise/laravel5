<?php
namespace App\Repositories;

use App\Models\TenantAddress;

class TenantAddressRepository
{
	public function find($id)
	{
		return TenantAddress::findOrFail($id);
	}

	public function all()
	{
		return TenantAddress::all();
	}

	public function create($input)
	{
		return TenantAddress::create($input);
	}

	public function destroy($id)
	{
		$object = TenantAddress::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = TenantAddress::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}