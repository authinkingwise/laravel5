<?php
namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
	public function find($id)
	{
		return Ticket::findOrFail($id);
	}

	public function all()
	{
		return Ticket::all();
	}

	public function destroy($id)
	{
		$object = Ticket::findOrFail($id);
		if ($object->delete()) {
			return true;
		} else {
			return false;
		}
	}

	public function update($input, $id)
	{
		$object = Ticket::findOrFail($id);
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
