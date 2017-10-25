<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\TenantRepository;

class SettingController extends Controller
{
    protected $tenant;

    public function __construct(TenantRepository $tenant)
	{
		$this->middleware('auth');

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
