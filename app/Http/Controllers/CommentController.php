<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Ticket;
use App\User;
use App\Models\TicketActivity;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['time'] != null) {
            $this->validate($request, [
                'time' => 'numeric'
            ]);
        }

        $input = $request->all();

        // Add comment
        $data = array();
        $data['ticket_id'] = $input['ticket_id'];
        $data['description'] = $input['comment_description'] ? $input['comment_description'] : null;
        $data['time'] = $input['time'] ? $input['time'] : null;
        $data['user_id'] = Auth::id();
        $data['tenant_id'] = Auth::user()->tenant_id;

        // Update ticket
        $ticket = Ticket::findOrFail($input['ticket_id']);

        if ($comment = Comment::create($data)) {
            
            if ($ticket->status_id != $input['status_id'] || $ticket->user_id != $input['user_id'] || $ticket->priority_id != $input['priority_id']) {
                $activity = new TicketActivity();
                $activity->comment_id = $comment->id;
                $activity->user_id = Auth::id();
                $activity->tenant_id = Auth::user()->tenant_id;

                $text = "Updated";

                if ($ticket->status_id != $input['status_id']) {
                    $status_1 = \App\Models\Status::findOrFail($ticket->status_id);
                    $status_2 = \App\Models\Status::findOrFail($input['status_id']);
                    $text.= " Status from " . $status_1->name . " to <strong>" . $status_2->name . "</strong>.";
                }

                if ($ticket->user_id != $input['user_id']) {
                    $user_1 = User::findOrFail($ticket->user_id);
                    $user_2 = User::findOrFail($input['user_id']);
                    $text.= " Assigned User from " . $user_1->name . " to <strong>" . $user_2->name . "</strong>.";
                }

                if ($ticket->priority_id != $input['priority_id']) {
                    $priority_1 = \App\Models\Priority::findOrFail($ticket->priority_id);
                    $priority_2 = \App\Models\Priority::findOrFail($input['priority_id']);
                    $text.= " Priority from " . $priority_1->name . " to <strong>" . $priority_2->name . "</strong>.";
                }

                $activity->text = $text;

                $activity->save();
            }

            $ticket->status_id = $input['status_id'] ? $input['status_id'] : null;
            $ticket->user_id = $input['user_id'] ? $input['user_id'] : null;
            $ticket->priority_id = $input['priority_id'] ? $input['priority_id'] : null;
            $ticket->last_update_user_id = Auth::id();
            $ticket->update($input);

            return redirect()->back()->with('success', 'Success to add the comment');
        } else {
            return redirect()->back()->with('error', 'Failed to add the comment');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->delete())
            return redirect()->back()->with('success', 'Success to delete the comment');
        else
            return redirect()->back()->with('error', 'Failed to delete the comment');
    }
}
