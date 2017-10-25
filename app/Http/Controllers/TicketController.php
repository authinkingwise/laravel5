<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Ticket;
use App\User;
use App\Models\Account;

use App\Repositories\TicketFileRepository;

class TicketController extends Controller
{
    protected $ticketFile;

    public function __construct(TicketFileRepository $ticketFile)
    {
        $this->middleware('auth');

        $this->ticketFile = $ticketFile;
    }

    public function index(Request $request)
	{
		$input = $request->all();

		if (Gate::denies('show-ticket'))
            return response()->view('errors.403', [], 403);

		$tickets = Ticket::where('tenant_id', '=', Auth::user()->tenant_id);

		if ($request['account_id'] != null) {
			$account = Account::findOrFail($request['account_id']);
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
			$tickets = $tickets->where('account_id' , '=', $request['account_id']);
		}
		if ($request['user_id'] != null) {
			$user = User::findOrFail($request['user_id']);
            if (Gate::denies('check-tenant-user', $user, Auth::user())) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
			$tickets = $tickets->where('user_id' , '=', $request['user_id']);
		}
		if ($request['status_id'] != null) {
			$tickets = $tickets->where('status_id' , '=', $request['status_id']);
		}
		if ($request['orderby'] != null) {
			if ($request['orderby'] == 'asc' || $request['orderby'] == 'desc')
				$tickets = $tickets->orderBy('updated_at', $request['orderby']);
		} else
			$tickets = $tickets->orderBy('updated_at', 'desc');

		$tickets = $tickets->paginate(10);

		// for the use of filter search
		$users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$statuses = \App\Models\Status::all();

		return view('ticket.index', [
			'tickets' => $tickets,
			'users' => $users,
			'accounts' => $accounts,
			'statuses' => $statuses,
			'request' => ($input != null) ? $input : null,
		]);
	}

	public function myTickets(Request $request)
	{
		if (Gate::denies('show-ticket'))
            return response()->view('errors.403', [], 403);

        $input = $request->all();

		$tickets = Ticket::where('tenant_id', '=', Auth::user()->tenant_id)
							->where('user_id', '=', Auth::id());

		if ($request['account_id'] != null) {
			$account = Account::findOrFail($request['account_id']);
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
			$tickets = $tickets->where('account_id' , '=', $request['account_id']);
		}

		if ($request['status_id'] != null) {
			$tickets = $tickets->where('status_id' , '=', $request['status_id']);
		}

		if ($request['orderby'] != null) {
			if ($request['orderby'] == 'asc' || $request['orderby'] == 'desc')
				$tickets = $tickets->orderBy('updated_at', $request['orderby']);
		} else
			$tickets = $tickets->orderBy('updated_at', 'desc');

		$tickets = $tickets->paginate(10);

		// for the use of filter search
		$users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$statuses = \App\Models\Status::all();

		return view('ticket.index', [
			'tickets' => $tickets,
			'myTicketsOnly' => true,
			'users' => $users,
			'accounts' => $accounts,
			'statuses' => $statuses,
			'request' => ($input != null) ? $input : null,
		]);
	}

	public function create(Request $request = null)
	{
		if (Gate::denies('create-ticket'))
            return response()->view('errors.403', [], 403);

		$users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$statuses = \App\Models\Status::all();
		$priorities = \App\Models\Priority::all();

		if ($request['account_id'] != null) {
            $account = Account::findOrFail($request['account_id']);
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
        }

		return view('ticket.create', [
			'users' => $users,
			'accounts' => $accounts,
			'statuses' => $statuses,
			'priorities' => $priorities,
			'related_account' => ($request['account_id'] != null) ? $account : null,
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
            'title' => 'required|max:255',
            'account_id' => 'required',
        ]);

        if ($request['estimated_time'] != null) {
        	$this->validate($request, [
            	'estimated_time' => 'numeric'
        	]);
        }

		$input = $request->all();
		$input['creator_id'] = Auth::id();
		$input['last_update_user_id'] = Auth::id();
        $input['tenant_id'] = Auth::user()->tenant_id;

        
        if ($ticket = Ticket::create($input)) {

        	// Attach files to ticket
        	if ($files = $request->file('files')) {
	        	foreach ($files as $file) {
	        		if ($file->isValid()) {
	        			$this->ticketFile->create($ticket->id, $file);
	        		}
	        	}
	        }

            return redirect('tickets/'.$ticket->id)->with('success', 'Success to add ticket.');
        }
        else
            return redirect()->back()->with('error', 'Failed to add ticket.');
	}

	public function show($id)
	{
		$ticket = Ticket::findOrFail($id);

		// Make sure not able to show other tenants' content
        if (Gate::denies('check-tenant-ticket', $ticket)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('show-ticket'))
            return response()->view('errors.403', [], 403);

        $users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
        $statuses = \App\Models\Status::all();
        $priorities = \App\Models\Priority::all();

        $comments = $ticket->comments;
        $time_spent = 0;

        foreach ($comments as $comment) {
        	$time_spent = $time_spent + $comment->time;
        }

        $attachments = $ticket->ticketFiles()->orderBy('created_at')->get();

		return view('ticket.show', [
			'ticket' => $ticket,
			'users' => $users,
			'statuses' => $statuses,
			'priorities' => $priorities,
			'comments' => $comments,
			'time_spent' => $time_spent,
			'attachments' => $attachments
		]);
	}

	public function edit($id)
	{
		$ticket = Ticket::findOrFail($id);

		// Make sure not able to show other tenants' content
        if (Gate::denies('check-tenant-ticket', $ticket)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('edit-ticket'))
            return response()->view('errors.403', [], 403);

		$users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		$statuses = \App\Models\Status::all();
		$priorities = \App\Models\Priority::all();

		$attachments = $ticket->ticketFiles()->orderBy('created_at')->get();

		return view('ticket.edit', [
			'ticket' => $ticket,
			'users' => $users,
			'accounts' => $accounts,
			'statuses' => $statuses,
			'priorities' => $priorities,
			'attachments' => $attachments
		]);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
            'title' => 'required|max:255',
            'account_id' => 'required',
        ]);

        if ($request['estimated_time'] != null) {
        	$this->validate($request, [
            	'estimated_time' => 'numeric'
        	]);
        }

        $ticket = Ticket::findOrFail($id);

        $input = $request->all();
        $input['last_update_user_id'] = Auth::id();

        if ($request['account_id'] != null) {
            $account = Account::findOrFail($request['account_id']);
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
        }

        if ($request['user_id'] != null) {
            $user = User::findOrFail($request['user_id']);
            if (Gate::denies('check-tenant-user', $user, Auth::user())) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
        }

        if ($ticket->update($input)) {
        	// Add attached files to the ticket
        	if ($files = $request->file('files')) {
	        	foreach ($files as $file) {
	        		if ($file->isValid()) {
	        			$this->ticketFile->create($ticket->id, $file);
	        		}
	        	}
	        }

        	return redirect('tickets/'.$ticket->id)->with('success', 'Success to edit ticket.');
        }
        else
        	return redirect()->back()->with('error', 'Failed to edit ticket.');
	}

	public function destroy($id)
	{
		$ticket = Ticket::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-ticket', $ticket)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('destroy-ticket'))
            return response()->view('errors.403', [], 403);

        if ($ticket->delete())
            return redirect()->back()->with('success', 'Success to delete the ticket');
        else
            return redirect()->back()->with('error', 'Failed to delete the ticket');
	}
}
