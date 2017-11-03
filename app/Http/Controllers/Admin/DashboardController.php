<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\User;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	protected function index()
	{
		// My Tickets
		$tickets = Ticket::where('tenant_id', '=', Auth::user()->tenant_id)
							->where('user_id', '=', Auth::id());

		$myTickets = Ticket::where('tenant_id', '=', Auth::user()->tenant_id)
							->where('user_id', '=', Auth::id())
							->orderBy('updated_at', 'desc')
							->get();

		$user = Auth::user();

		$myTasks = $user->tasks()->where('schedule_id', '!=', 6)->orderBy('project_id')->get();

		$tasks = $myTasks->reject(function($task){
			return $task->project->status == 0;
		});

		return view('dashboard.index', [
			'tickets' => $tickets->orderBy('updated_at', 'desc')->take(6)->get(),
			'countTickets' => count($tickets->orderBy('updated_at', 'desc')->get()),

			'newTickets' => Ticket::where('tenant_id', '=', Auth::user()->tenant_id)->where('status_id', '=', 1)->get(),
			'assignedTickets' => Ticket::where('tenant_id', '=', Auth::user()->tenant_id)->where('status_id', '=', 2)->get(),
			'inProgressTickets' => Ticket::where('tenant_id', '=', Auth::user()->tenant_id)->where('status_id', '=', 3)->get(),
			'pendingTickets' => Ticket::where('tenant_id', '=', Auth::user()->tenant_id)->where('status_id', '=', 4)->get(),
			'resolvedTickets' => Ticket::where('tenant_id', '=', Auth::user()->tenant_id)->where('status_id', '=', 5)->get(),

			'myTickets' => $myTickets,
			'myTasks' => $tasks,
		]);
	}
}
