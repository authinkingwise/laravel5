<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
	public function find($id)
	{
		return Task::findOrFail($id);
	}

	public function all()
	{
		return Task::all();
	}

	public function destroy($id)
	{
		$object = Task::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Task::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
