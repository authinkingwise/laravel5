<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Tenant;
use App\Models\Role;
use App\Models\Permission;
use App\Notifications\TenantCreated;

class TenantController extends Controller
{
     /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Create a new tenant instance.
	 *
	 * @param  array $data
	 * @return \App\Tenant
	 */
	protected function create(Request $request)
	{
		$password = bcrypt($request->input('password'));

		if ($tenant = Tenant::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => $password,
		])) {

			// Copy the new registered tenant details to user table as the admin user.
			$user = User::create([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'password' => $password,
				'tenant_id' => $tenant->id ? $tenant->id : null,
			]);

			// Create a default admin role for the user
			$role = Role::create([
				'name' => 'admin',
				'label' => 'Admin',
				'tenant_id' => $tenant->id
			]);

			// Link all permissions to this admin role
			$permissions = Permission::all();
			foreach ($permissions as $permission) {
				$role->givePermissionTo($permission);
			}
			
			// Assign the default admin role to this new user
			// $user->assignRole($role);
			$user->roles()->attach($role->id, ['user_id' => $user->id]);

			/* Notification TenantCreated */
			$tenantCreated = new TenantCreated($tenant);
			$user->notify($tenantCreated);

			return redirect('/')->with('success', 'Welcome ' . $user->name . "! Your account has been created.");
		}
		else 
			return "Whoos, something wrong.";
	}
	
	protected function register()
	{
		return view('tenant.register');
	}
}
