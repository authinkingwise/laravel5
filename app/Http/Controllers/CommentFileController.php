<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Repositories\CommentFileRepository;
use App\Models\CommentFile;

class CommentFileController extends Controller
{
    protected $commentFile;

    public function __construct(CommentFileRepository $commentFile)
    {
        $this->middleware('auth');

        $this->commentFile = $commentFile;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = $this->commentFile->find($id);

        $path = storage_path('app/public/app') . '/' . (string)Auth::user()->tenant_id . '/' . $file->file;

        return response()->download($path, null, [], null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->commentFile->destroy($id))
            return redirect()->back()->with('success', 'File deleted.');
        else
            return redirect()->back()->with('success', 'File not deleted yet.');
    }
}
