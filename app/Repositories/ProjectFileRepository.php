<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\ProjectFile;

class ProjectFileRepository
{
	/**
     * Create a new ProjectFile.
     *
     * @param  int  $project_id
     * @param  object  $file
     * @return boolean
     */
	public function create($project_id, $file)
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
			'project_id' => $project_id,
			'file' => $filename
		);

		if (ProjectFile::create($input) == false) {
			return redirect()->back()->with('error', 'Failed to add file to database - ' . $filename);
		}
	}

	/**
     * Retrieve a ProjectFile.
     *
     * @param  int  $id
     * @return App\Models\ProjectFile
     */
	public function find($id)
	{
		$file = ProjectFile::findOrFail($id);

		return $file;
	}

	public function destroy($id)
	{
		$file = ProjectFile::findOrFail($id);

		$relative_path = (string)Auth::user()->tenant_id . '/' . $file->file;

		Storage::disk('app')->delete($relative_path);

		if ($file->delete())
			return true;
		else
			return false;
	}
}