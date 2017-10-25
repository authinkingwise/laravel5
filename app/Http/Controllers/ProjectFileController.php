<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Repositories\ProjectFileRepository;
use App\Models\ProjectFile;

class ProjectFileController extends Controller
{
    protected $projectFile;

    public function __construct(ProjectFileRepository $projectFile)
    {
        $this->middleware('auth');

        $this->projectFile = $projectFile;
    }

    public function show($id)
    {
    	$file = $this->projectFile->find($id);

    	$path = storage_path('app/public/app') . '/' . (string)Auth::user()->tenant_id . '/' . $file->file;

    	return response()->download($path, null, [], null);
    }

    public function destroy($id)
    {
    	if ($this->projectFile->destroy($id))
			return redirect()->back()->with('success', 'File deleted.');
		else
			return redirect()->back()->with('success', 'File not deleted yet.');
    }
}
