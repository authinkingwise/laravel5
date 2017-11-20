<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Notifications\InviteUser;

class UserController extends Controller
{
    protected $redirectTo = '/users';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show-user'))
            return response()->view('errors.403', [], 403);

        $users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
        $total = $users->count();

        $users = User::where('tenant_id', '=', Auth::user()->tenant_id)->paginate(10);

        return view('user.index', [
            'users' => $users,
            'total' => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-user'))
            return response()->view('errors.403', [], 403);

        $roles = Role::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        return view('user.create', [
            'roles' => $roles
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
        $this->validator($request->all())->validate();
        
        // if (isset($request['role_id']) && $request['role_id'] != null)
        //     dd($request['role_id']);
        // dd($request);

        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->tenant_id = Auth::user()->tenant_id;

        if (isset($request['role_id']) && $request['role_id'] != null)
            $role = Role::findOrFail($request['role_id']);

        if ($user->save()) {
            // $user->roles()->attach($request->role_id, ['user_id' => $user->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            if (isset($request['role_id']) && $request['role_id'] != null) {
                // Sometime different customers have the same role name 
                // $user->assignRole( $role->name );
                $user->roles()->attach($request['role_id'], ['user_id' => $user->id]);
            }

            /* Notification InviteUser */
            $inviteUser = new InviteUser($user, Auth::user(), $request['password']);
            $user->notify($inviteUser);
            
            return redirect('users')->with('success', 'Success to add ' . $user->name . ' and a mesaage has been sent to the new user.');
        } else {
            return redirect()->back()->with('error', 'Failed to add ' . $request['name']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);

        // Make sure not able to edit other tenants' content
        if (Gate::denies('check-tenant-user', $user, Auth::user())) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('show-user'))
            return response()->view('errors.403', [], 403);

        $tickets = $user->tickets()->orderBy('updated_at', 'desc')->get();

        $tasks = $user->tasks()->where('schedule_id', '!=', 6)->orderBy('project_id')->get();

        $tasks = $tasks->reject(function($task){
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
            if ($planning->schedule_date != null) {
                $w = (int)date('W', strtotime($planning->schedule_date));
            } else {
                if ($planning->actual_date != null) {
                    $w = (int)date('W', strtotime($planning->actual_date));
                }
            }
            return $planning->ticket_id == null || $week_number != $w;
        })->groupBy('ticket_id');

        // $task_plannings = $plannings->reject(function($planning){
        //     return $planning->task_id == null;
        // });

        $task_plannings = $plannings->reject(function($planning) use ($week_number) {
            $w = (int)date('W', strtotime($planning->schedule_date));
            return $planning->task_id == null || $week_number != $w;
        })->groupBy('project_id');

        $project_plannings = $plannings->reject(function($planning){
            return $planning->project_id == null;
        });

        // $today = date('W');
        // var_dump($today);
        // dd($today);

        return view('user.show', [
            'user' => $user,
            'tickets' => $tickets,
            'tasks' => $tasks,
            'plannings' => $plannings,
            'ticket_plannings' => $ticket_plannings,
            'task_plannings' => $task_plannings,
            'project_plannings' => $project_plannings,
            'week_page' => $week_page,
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
        $user = User::findOrFail($id);

        // Make sure not able to edit other tenants' content
        if (Gate::denies('check-tenant-user', $user, Auth::user())) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('edit-user'))
            return response()->view('errors.403', [], 403);

        $roles = Role::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        return view('user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
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
        $user = User::findOrFail($id);

        // Validate the input value
        if ($request['password'] != null) {
            Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed'
            ])->validate();
        }
        else {
            $array_name = array('name' => $request['name']);
            $array_email = array('email' => $request['email']);

            if ($user->name != $request['name']) {
                Validator::make($array_name, [
                    'name' => 'required|max:255'
                ])->validate();
            }
            if ($user->email != $request['email']) {
                Validator::make($array_email, [
                    'email' => 'required|string|email|max:255'
                ])->validate();
            }
        }

        if ($user->roles->first() != null)
            $roleId = $user->roles->first()->id; // User's current role
        else
            $roleId = null;

        $user->name = $request['name'];
        $user->email = $request['email'];

        // Update password if it is changed
        if ($request['password'] != null) {
            if (!Hash::check($request['password'], $user->password)) {
                $user->password = bcrypt($request['password']);
            }
        }

        $user->save(); // Save the user

        // Update user's role
        if ($request['role_id'] != $roleId) {
            if ($roleId != null) {
                $user->roles()->detach($roleId);
            }
            // $user->assignRole( Role::find($request['role_id'])->name );
            // Sometime different customers have the same role name 
            $user->roles()->attach($request['role_id'], ['user_id' => $user->id]);
        }

        return redirect('users/'.$user->id)->with('success', 'Success to update ' . $user->name);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-user', $user, Auth::user())) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('destroy-user'))
            return response()->view('errors.403', [], 403);

        if ($user->delete())
            return redirect('users')->with('success', 'Success to delete the user');
        else
            return redirect()->back();
    }

    /**
     * Send an email to invite the new user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request = null, $id)
    {
        $user = User::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-user', $user, Auth::user())) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('create-user'))
            return response()->view('errors.403', [], 403);

        /* Notification InviteUser */
        if ($request['_token'] != null) {
            $token = app('auth.password.broker')->createToken($user);
            $inviteUser = new InviteUser($user, Auth::user(), $password = null, $token);
        }
        else
            $inviteUser = new InviteUser($user, Auth::user());
        
        $user->notify($inviteUser);
        
        return redirect()->back()->with('success', 'Sent a message to invite the user ' . $user->name);
    }
}
