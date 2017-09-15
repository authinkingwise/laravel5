<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Account;
use App\User;
use App\Models\Tenant;

class AccountController extends Controller
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
        $tenant_id = Auth::user()->tenant_id;
        $accounts = Account::where('tenant_id', '=', $tenant_id)->paginate(12);
    	return view('account.index', [
    		'accounts' => $accounts
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-account'))
            return response()->view('errors.403', [], 403);

        return view('account.create');
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);

        if (isset($account)) {
            // Make sure not able to show other tenants' content
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
        }

        if (Gate::denies('show-account'))
            return response()->view('errors.403', [], 403);

        // $tickets = $account->tickets;
        // $users = User::where('tenant_id', '=', $tenant_id);

        if( isset($account->contacts) )
            $contacts = $account->contacts->take(3); // Contacts for this account

    	return view('account.show', [
    		'account' => $account,
            // 'tickets' => $tickets,
            // 'users' => $users,
            'contacts' => isset($contacts) ? $contacts : null
    	]);
    }

    public function add()
    {
        return view('account.add_edit');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);

        // Make sure not able to show other tenants' content
        if (Gate::denies('check-tenant-account', $account)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('edit-account'))
            return response()->view('errors.403', [], 403);

        return view('account.edit', [
            'account' => $account
        ]);
    }

    public function destroy($id)
    {
        $account = Account::find($id);

        $contacts = $account->contacts;

        if (count($contacts)) {
            foreach ($contacts as $contact) {
                $contact->account_id = null;
                $contact->save();
            }
        }

        if ($account->delete()) {
            return redirect('accounts')->with('success', 'Success to delete ' . $account->name);
        } else {
            return redirect()->back()->with('error', 'Failed to delete ' . $account->name);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        if ($request['email'] != null) {
            $this->validate($request, [
                'email' => 'string|email|max:255'
            ]);
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['tenant_id'] = Auth::user()->tenant_id;

        if ($account = Account::create($input))
            return redirect('accounts/'.$account->id)->with('success', 'Success to add ' . $account->name);
        else
            return redirect()->back()->with('error', 'Failed to add');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        if ($request['email'] != null) {
            $this->validate($request, [
                'email' => 'string|email|max:255'
            ]);
        }

        $account = Account::findOrFail($id);

        $input = $request->all();
        $input['user_id'] = Auth::id();

        if ($account->update($input))
            return redirect('accounts/'.$account->id)->with('success', 'Success to update ' . $account->name);
        else
            return redirect()->back()->with('success', 'Failed to update' . $account->name);
    }
}
