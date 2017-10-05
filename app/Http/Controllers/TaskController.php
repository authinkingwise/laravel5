<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\Project;
use App\User;
use App\TaskSchedule;

class TaskController extends Controller
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
    public function index()
    {
        $tasks = Task::where('tenant_id', '=', Auth::user()->tenant_id)->paginate(10);

        return view('task.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['creator_id'] = Auth::id();
        $input['last_update_user_id'] = Auth::id();
        $input['tenant_id'] = Auth::user()->tenant_id;

        // dd($input);

        if ($task = Task::create($input)) {
            return redirect()->back()->with('success', 'Success to add task.');
        } else {
            return redirect()->back()->with('error', 'Failed to add task.');
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
        $task = Task::findOrFail($id);
        return $task;
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
        $task = Task::findOrFail($id);

        $input = $request->all();
        $input['last_update_user_id'] = Auth::id();

        if ($task->update($input)) {
            return redirect()->back()->with('success', 'Success to edit task.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit task.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-task', $task)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('destroy-task'))
            return response()->view('errors.403', [], 403);

        if ($task->delete())
            return redirect()->back()->with('success', 'Success to delete the task');
        else
            return redirect()->back()->with('error', 'Failed to delete the task');
    }

    public function getTask(Request $request)
    {
        $task_id = $request->input('task_id');
        $task = Task::findOrFail($task_id);

        return $task;
    }
}
