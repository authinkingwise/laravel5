<?php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
	public function find($id)
	{
		return Project::findOrFail($id);
	}

	public function all()
	{
		return Project::all();
	}

	public function destroy($id)
	{
		$object = Project::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Project::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
