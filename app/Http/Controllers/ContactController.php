<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Contact;
use App\User;
use App\Models\Account;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['account_id'] != null) {
            $account = Account::find($request['account_id']);
            // Make sure not able to show other tenants' content
            if (isset($account)) {
                if (Gate::denies('check-tenant-account', $account)) {
                    return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
                }
            }
        }

        if (Gate::denies('show-contact'))
            return response()->view('errors.403', [], 403);

        if ($request['account_id'] == null)
            $contacts = Contact::where('tenant_id', '=', Auth::user()->tenant_id)->paginate(10);
        else {
            $contacts = Contact::where('tenant_id', '=', Auth::user()->tenant_id)
                                ->where('account_id' , '=', $request['account_id'])
                                ->paginate(10);
        }

        return view('contact.index', [
            'contacts' => $contacts,
            'account' => isset($account) ? $account : null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-contact'))
            return response()->view('errors.403', [], 403);

        $accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        return view('contact.create', [
            'accounts' => $accounts
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
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'account_id' => 'required'
        ]);

        if ($request['email'] != null) {
            $this->validate($request, [
                'email' => 'string|email|max:255'
            ]);
        }
        
        $input = $request->all();
        $input['tenant_id'] = Auth::user()->tenant_id;

        if ($contact = Contact::create($input))
            return redirect('contacts/'.$contact->id)->with('success', 'Success to add ' . $contact->firstname);
        else
            return redirect()->back()->with('error', 'Failed to add ' . $request['firstname']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // Make sure not able to show other tenants' content
        if (Gate::denies('check-tenant-contact', $contact)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('show-contact'))
            return response()->view('errors.403', [], 403);

        return view('contact.show', [
            'contact' => $contact
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
        $contact = Contact::findOrFail($id);
        $accounts = Account::where('tenant_id', '=', Auth::user()->tenant_id)->get();

        // Make sure not able to edit other tenants' content
        if (Gate::denies('check-tenant-contact', $contact)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('edit-contact'))
            return response()->view('errors.403', [], 403);

        return view('contact.edit', [
            'contact' => $contact,
            'accounts' => $accounts
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
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'account_id' => 'required'
        ]);

        if ($request['email'] != null) {
            $this->validate($request, [
                'email' => 'string|email|max:255'
            ]);
        }

        $contact = Contact::findOrFail($id);

        $input = $request->all();

        if ($request['account_id'] != null) {
            $account = Account::findOrFail($request['account_id']);
            if (Gate::denies('check-tenant-account', $account)) {
                return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
            }
        }

        $contact->update($input);

        return redirect('contacts/'.$contact->id)->with('success', 'Success to update ' . $contact->firstname);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        // Make sure not able to delete other tenants' content
        if (Gate::denies('check-tenant-contact', $contact)) {
            return response()->view('errors.403', ['errorTenant' => Auth::user()->tenant_id], 403);
        }

        if (Gate::denies('destroy-contact'))
            return response()->view('errors.403', [], 403);

        if ($contact->delete())
            return redirect()->back()->with('success', 'Success to delete the contact');
        else
            return redirect()->back();
    }
}
