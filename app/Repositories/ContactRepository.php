<?php
namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
	public function find($id)
	{
		return Contact::findOrFail($id);
	}

	public function all()
	{
		return Contact::all();
	}

	public function destroy($id)
	{
		$object = Contact::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Contact::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
