<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
	public function find($id)
	{
		return Comment::findOrFail($id);
	}

	public function all()
	{
		return Comment::all();
	}

	public function destroy($id)
	{
		$object = Comment::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Comment::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
