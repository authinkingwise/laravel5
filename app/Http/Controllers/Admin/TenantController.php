<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Tenant;

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

			$user = User::create([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'password' => $password,
				'tenant_id' => $tenant->id ? $tenant->id : null,
			]);

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
