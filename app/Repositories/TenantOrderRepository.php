<?php
namespace App\Repositories;

use App\Models\TenantOrder;

class TenantOrderRepository
{
	public function find($id)
	{
		return TenantOrder::findOrFail($id);
	}

	public function all()
	{
		return TenantOrder::all();
	}

	public function destroy($id)
	{
		$object = TenantOrder::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = TenantOrder::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}