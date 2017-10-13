<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        if ($file = $request->file('avatar')) {
            if ($file->isValid()) {
                $originalName = $file->getClientOriginalName(); // original name
                $ext = $file->getClientOriginalExtension(); // ext
                $type = $file->getClientMimeType(); // MimeType
                $realPath = $file->getRealPath(); // tmp path
                $filename = time() . '-' . $originalName;
                $storage = Storage::disk('profile')->put((string)$user->tenant_id . '/' . (string)Auth::id() . '/' . $filename, file_get_contents($realPath));

                if ($storage) {
                    if ($user->avatar != null) {
                        Storage::disk('profile')->delete((string)$user->tenant_id . '/' . (string)Auth::id() . '/' . $user->avatar); // delete the old file
                    }
                }

                $user->avatar = $filename;
            }
        }

        $user->full_name = $input['full_name'];

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
            if ($user->save())
                return redirect('profile')->with('success', 'Hi ' . $user->name . ', the password remains the same.');
        }

    }
}
