<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$user = Auth::user();

    	return view('profile.show', [
    		'user' => $user
    	]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();

        if ($request['password'] != null) {
            Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed'
            ])->validate();

            if (!Hash::check($request['password'], $user->password)) {
                $user->password = bcrypt($request['password']);
                if ($user->save())
                    return redirect('profile')->with('success', 'Hi ' . $user->name . ', the password has been updated.');
                else
                    return redirect('profile')->with('error', 'Sorry ' . $user->name . ', the password failed to update.');
            } else {
                return redirect('profile')->with('success', 'Hi ' . $user->name . ', the password keeps the same.');
            }
        } else {
            return redirect('profile')->with('success', 'Hi ' . $user->name . ', the password remains the same.');
        }

    }
}
