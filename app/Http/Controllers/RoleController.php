<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
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
        $roles = Role::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        return view('role.index', [
            'roles' => $roles,
            'total' => $roles->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $controllers = ['account', 'contact', 'ticket', 'comment', 'project', 'task', 'user', 'role'];

        return view('role.create', [
            'permissions' => $permissions,
            'controllers' => $controllers,
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
        $input = $request->all();
        $input['tenant_id'] = Auth::user()->tenant_id;

        if ($role = Role::create($input)) {

            foreach ($request['permissions'] as $value) {
                $permission = Permission::findOrFail($value);
                $role->givePermissionTo($permission);
            }

            return redirect('roles');
        }
        else
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        // Make sure not able to edit other tenants' content
        if (Gate::denies('check-tenant-role', $role)) { //Auth::user()->roles->first()
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('edit-role', Auth::user()))
            return response()->view('errors.403', [], 403);

        $currentPermissions = $role->permissions; // this role's existing permissions.
        $currentPermissionsId = array();
        foreach ($currentPermissions as $value) {
            $currentPermissionsId[] =  $value['id'];
        }

        $allPermissions = Permission::all(); // all default permissions

        $controllers = ['account', 'contact', 'ticket', 'comment', 'project', 'task', 'user', 'role'];

        return view('role.edit', [
            'role' => $role,
            'currentPermissionsId' => $currentPermissionsId,
            'allPermissions' => $allPermissions,
            'controllers' => $controllers,
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
        $role = Role::findOrFail($id);
        $input = array();
        $input['name'] = $request['name'];
        $input['label'] = $request['label'];
        $role->update($input); // update the role name and label

        $currentPermissions = $role->permissions; // this role's existing permissions.

        $currentPermissionsId = array(); // this role's existing permission ids.
        foreach ($currentPermissions as $value) {
            $currentPermissionsId[] =  $value['id'];
        }

        // Add new permissions to the role
        foreach ($request['permissions'] as $value) {
            if ( in_array($value, $currentPermissionsId) == false ) {
                $p = Permission::findOrFail($value);
                $role->givePermissionTo($p);
            }
        }

        // Remove the unticked permissions from the role
        foreach ($currentPermissionsId as $value) {
            if ( in_array($value, $request['permissions']) == false ) {
                $role->permissions()->detach($value);
            }
        }
        
        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-role', $role)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if ($role->delete()) {
            return redirect('roles');
        } else {
            return redirect()->back();
        }
    }
}
