<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Project;
use App\User;
use App\Models\Account;
use App\Models\TaskSchedule;

class ProjectController extends Controller
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
        
        $projects = Project::where('tenant_id', '=', Auth::user()->tenant_id)->paginate(10);

        return view('project.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
        $accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        return view('project.create', [
            'users' => $users,
            'accounts' => $accounts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $input = $request->all();

        $allowed_users_text = "";

        if ($input['visible']) {
            $allowed_users_text = null;
        } else {
            if ( isset($input['allowed_users']) ) {
                foreach ($input['allowed_users'] as $index => $val) {
                    if ($index == 0) {
                        $allowed_users_text.= $val;
                    } else {
                        $allowed_users_text.= ";" . $val;
                    }
                }
                if ( !in_array(Auth::id(), $input['allowed_users']) ) {
                    $allowed_users_text.= ";" . Auth::id();
                }
            } else {
                $allowed_users_text = Auth::id();
            }
        }

        $data = array(
            'name' => $input['name'],
            'description' => $input['description'],
            'account_id' => $input['account_id'],
            'user_id' => $input['user_id'],
            'creator_id' => Auth::id(),
            'status' => isset($input['status']) ? $input['status'] : 1,
            'visible' => isset($input['visible']) ? $input['visible'] : 1,
            'allowed_users' => $allowed_users_text,
            'last_update_user_id' => Auth::id(),
            'tenant_id' => Auth::user()->tenant_id,
        );

        if ($project = Project::create($data)) {
            return redirect('projects/' . $project->id)->with('success', 'Success to add project.');
        } else {
            return redirect()->back()->with('error', 'Failed to add project.');
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
        $project = Project::findOrFail($id);

        // Make sure not able to show other tenants' content
        if (Gate::denies('check-tenant-project', $project)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('show-project', $project)) {
            return response()->view('errors.403', ['errorProjectVisible' => 1], 403);
        }

        $users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
        $accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        $allowed_users = array();
        if ($project->visibleToUsers() != null) {
            foreach($project->visibleToUsers() as $user_id) {
                $allowed_users[] = User::findOrFail($user_id);
            }
            $allowed_users_ids = $project->visibleToUsers();
        }

        $schedules = TaskSchedule::all();

        $tasks = $project->tasks;
        
        return view('project.show', [
            'project' => $project,
            'users' => $users,
            'accounts' => $accounts,
            'allowed_users' => ($allowed_users != null) ? $allowed_users : null,
            'allowed_users_ids' => isset($allowed_users_ids) ? $allowed_users_ids : null,
            'schedules' => $schedules,

            'tasks' => $tasks,
            'newTasks' => $project->tasks()->where('schedule_id', '=', 1)->orderBy('order_index', 'asc')->orderBy('id', 'desc')->get(),
            'todoTasks' => $project->tasks()->where('schedule_id', '=', 2)->orderBy('order_index', 'asc')->orderBy('id', 'desc')->get(),
            'workingOnTasks' => $project->tasks()->whereIn('schedule_id', [3,4,5])->orderBy('order_index', 'asc')->orderBy('id', 'desc')->get(),
            'completedTasks' => $project->tasks()->where('schedule_id', '=', 6)->orderBy('order_index', 'asc')->orderBy('id', 'desc')->get(),
        ]);
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $project = Project::findOrFail($id);

        $input = $request->all();

        $allowed_users_text = "";

        if ($input['visible']) {
            $allowed_users_text = null;
        } else {
            if ( isset($input['allowed_users']) ) {
                foreach ($input['allowed_users'] as $index => $val) {
                    if ($index == 0) {
                        $allowed_users_text.= $val;
                    } else {
                        $allowed_users_text.= ";" . $val;
                    }
                }
                if ( !in_array($project->creator_id, $input['allowed_users']) ) {
                    $allowed_users_text.= ";" . Auth::id();
                }
            } else {
                $allowed_users_text = $project->creator_id;
            }
        }

        $data = array(
            'name' => $input['name'],
            'description' => $input['description'],
            'account_id' => $input['account_id'],
            'user_id' => $input['user_id'],
            'status' => isset($input['status']) ? $input['status'] : 1,
            'visible' => isset($input['visible']) ? $input['visible'] : 1,
            'allowed_users' => $allowed_users_text,
            'last_update_user_id' => Auth::id(),
        );

        if ($project->update($data)) {
            return redirect('projects/' . $project->id)->with('success', 'Success to edit project.');
        } else {
            return redirect('projects/' . $project->id)->with('error', 'Failed to edit project.');
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
        $project = Project::findOrFail($id);

        if ($project->delete())
            return redirect()->back()->with('success', 'Success to delete the project');
        else
            return redirect()->back()->with('error', 'Failed to delete the project');
    }
}
