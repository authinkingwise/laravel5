<?php
namespace App\Repositories;

use App\Models\Planning;

class PlanningRepository
{
	public function find($id)
	{
		return Planning::findOrFail($id);
	}

	public function all()
	{
		return Planning::all();
	}

	public function create($input)
	{
		return Planning::create($input);
	}

	public function destroy($id)
	{
		$object = Planning::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Planning::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}