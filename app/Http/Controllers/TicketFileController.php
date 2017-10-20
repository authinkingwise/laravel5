<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Repositories\TicketFileRepository;

class TicketFileController extends Controller
{
    protected $ticketFile;

    public function __construct(TicketFileRepository $ticketFile)
    {
        $this->middleware('auth');

        $this->ticketFile = $ticketFile;
    }

    public function show($id)
    {
    	$file = $this->ticketFile->find($id);

    	$path = storage_path('app/public/app') . '/' . (string)Auth::user()->tenant_id . '/' . (string)Auth::id() . '/' . $file->file;

    	return response()->download($path, null, [], null);
    }
}
