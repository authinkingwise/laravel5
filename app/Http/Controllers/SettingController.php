<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Repositories\TenantRepository;

class SettingController extends Controller
{
    protected $tenant;

    public function __construct(TenantRepository $tenant)
	{
		$this->middleware('auth');

        // Determine if the user is the tenant owner
        $this->middleware(function($request, $next) {
            if (Gate::denies('tenant-owner'))
                return response()->view('errors.403', [], 403);
            return $next($request);
        });

		$this->tenant = $tenant;
	}

    public function index()
    {
    	$tenant = $this->tenant->find(Auth::user()->tenant_id);

    	return view('setting.index', [
    		'tenant' => $tenant,
    	]);
    }

    public function setAccount()
    {

    }
}
