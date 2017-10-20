<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\TicketFile;

class TicketFileRepository
{
	/**
     * Create a new TicketFile.
     *
     * @param  int  $ticket_id
     * @param  object  $file
     * @return boolean
     */
	public function create($ticket_id, $file)
	{
		$originalName = $file->getClientOriginalName(); // original name
        $ext = $file->getClientOriginalExtension(); // ext
        $type = $file->getClientMimeType(); // MimeType
        $realPath = $file->getRealPath(); // tmp path
        $filename = time() . '-' . $originalName;
        $storage = Storage::disk('app')->put((string)Auth::user()->tenant_id . '/' . (string)Auth::id() . '/' . $filename, file_get_contents($realPath));

        if ($storage == null || $storage == false) {
        	return redirect()->back()->with('error', 'Failed to upload file ' . $filename);
        }

		$input = array(
			'ticket_id' => $ticket_id,
			'file' => $filename
		);

		if (TicketFile::create($input)) {
			return true;
		} else {
			return redirect()->back()->with('error', 'Failed to add file to database - ' . $filename);
		}
	}

	/**
     * Retrieve a TicketFile.
     *
     * @param  int  $id
     * @return App\Models\TicketFile
     */
	public function find($id)
	{
		$file = TicketFile::findOrFail($id);

		return $file;
	}

}