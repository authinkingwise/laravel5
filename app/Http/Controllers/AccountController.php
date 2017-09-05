<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Account;
use App\User;
use App\Models\Tenant;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tenant_id = Auth::user()->tenant_id;
        $tenant = Tenant::find($tenant_id);
        return $tenant;
        $accounts = Account::paginate(12);
    	return view('account.index', [
    		'accounts' => $accounts
    	]);
    }
}
