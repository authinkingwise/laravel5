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
        $accounts = Account::where('tenant_id', '=', $tenant_id)->paginate(12);
    	return view('account.index', [
    		'accounts' => $accounts
    	]);
    }

    public function view($id)
    {
        $account = Account::find($id);
        $tickets = $account->tickets;
        $users = User::where('tenant_id', '=', $tenant_id);
        $contacts = $account->contacts->take(6); // Contacts for this account
    	return view('account.view', [
    		'account' => $account,
            'tickets' => $tickets,
            'users' => $users,
            'contacts' => $contacts
    	]);
    }

    public function add()
    {
        return view('account.add_edit');
    }

    public function edit($id)
    {
        $account = Account::find($id);
        return view('account.add_edit', ['account' => $account]);
    }

    public function delete($id)
    {
        $account = Account::find($id);

        if ($account->delete()) {
            return redirect('account')->with('success', 'Success to delete ' . $account->name);
        } else {
            return redirect()->back()->with('error', 'Failed to delete ' . $account->name);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user(); // the login user
        $data = $request->input('Account');
        $data['user_id'] = Auth::id();
        $data['tenant_id'] = $user->tenant_id;

        if ($account = Account::create($data))
            return redirect('account')->with('success', 'Success to add ' . $data['name']);
        else
            return redirect()->back()->with('error', 'Failed to add');
    }

    public function update($id, Request $request)
    {
        $account = Account::findOrFail($id);
        $account->update($request->input('Account'));
        return redirect('account');
    }
}
