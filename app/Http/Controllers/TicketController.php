<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected function index()
	{
		return view('ticket.index');
	}
}
