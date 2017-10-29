<?php
namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
	public function find($id)
	{
		return Account::findOrFail($id);
	}

	public function all()
	{
		return Account::all();
	}

	public function destroy($id)
	{
		$object = Account::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Account::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
