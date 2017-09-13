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
            return redirect('users')->with('success', 'Success to add ' . $user->name);
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
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Make sure not able to edit other tenants' content
        if (Gate::denies('check-tenant-user', $user, Auth::user())) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('show-user'))
            return response()->view('errors.403', [], 403);

        return view('user.show', [
            'user' => $user
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

        $roleId = $user->roles->first()->id; // User's current role

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
            $user->roles()->detach($roleId);
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
}
