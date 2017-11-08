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

	protected function index(Request $request)
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

		// Plannings
		$week_page = 0;
        if (isset($request['week'])) {
            $week_page = (int)$request['week'];
        }

        $week_number = (int)date('W') + $week_page; // week number of year

        $plannings = $user->plannings;

        $ticket_plannings = $plannings->reject(function($planning) use ($week_number) {
            $w = (int)date('W', strtotime($planning->schedule_date));
            return $planning->ticket_id == null || $week_number != $w;
        })->groupBy('ticket_id');

        $task_plannings = $plannings->reject(function($planning) use ($week_number) {
            $w = (int)date('W', strtotime($planning->schedule_date));
            return $planning->task_id == null || $week_number != $w;
        })->groupBy('project_id');

        $project_plannings = $plannings->reject(function($planning){
            return $planning->project_id == null;
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

			'plannings' => $plannings,
            'ticket_plannings' => $ticket_plannings,
            'task_plannings' => $task_plannings,
            'project_plannings' => $project_plannings,
            'week_page' => $week_page,
		]);
	}
}
