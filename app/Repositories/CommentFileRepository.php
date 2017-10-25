<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\CommentFile;

class CommentFileRepository
{
	/**
     * Create a new CommentFile.
     *
     * @param  int  $comment_id
     * @param  object  $file
     * @return boolean
     */
	public function create($comment_id, $file)
	{
		$originalName = $file->getClientOriginalName(); // original name
        $ext = $file->getClientOriginalExtension(); // ext
        $type = $file->getClientMimeType(); // MimeType
        $realPath = $file->getRealPath(); // tmp path
        $filename = time() . '-' . $originalName;
        $storage = Storage::disk('app')->put((string)Auth::user()->tenant_id . '/' . $filename, file_get_contents($realPath));

        if ($storage == null || $storage == false) {
        	return redirect()->back()->with('error', 'Failed to upload file ' . $filename);
        }

		$input = array(
			'comment_id' => $comment_id,
			'file' => $filename
		);

		if (CommentFile::create($input)) {
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
		$file = CommentFile::findOrFail($id);

		return $file;
	}

	public function destroy($id)
	{
		$file = CommentFile::findOrFail($id);

		$relative_path = (string)Auth::user()->tenant_id . '/' . $file->file;

		Storage::disk('app')->delete($relative_path);

		if ($file->delete())
			return true;
		else
			return false;
	}
}