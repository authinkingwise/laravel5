<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Ticket;
use App\User;

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
        $ticket->status_id = $input['status_id'] ? $input['status_id'] : null;
        $ticket->user_id = $input['user_id'] ? $input['user_id'] : null;
        $ticket->priority_id = $input['priority_id'] ? $input['priority_id'] : null;
        $ticket->last_update_user_id = Auth::id();
        $ticket->update($input);

        if ($comment = Comment::create($data)) {
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
