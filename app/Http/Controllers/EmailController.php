<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\EmailContactus;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function contactUs(Request $request)
    {   Log::useDailyFiles(storage_path().'/logs/laravenew.log');
        Log::info('Invoking EmailController.................Validation is called start');
        $this->validate ($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|regex:/[0-9]/|max:12'
        ]);
        Log::info('Invoking EmailController.................Validation is called end');
        #
        if ($request->has('name')) {
            Log::info('Invoking EmailController.................Name is not empty');
            #dd($request->get('name'));
        }
        if ($request->has('email')) {
            Log::info('Invoking EmailController.................Email is not empty');
            # dd($request->get('email'));
        }
        if ($request->has('phone')) {
            Log::info('Invoking EmailController.................Phone is not empty');
            #dd($request->get('phone'));
        }
        if ($request->has('message')) {
            Log::info('Invoking EmailController.................Message is not empty');
            #dd($request->get('message'));
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $message = $request->input('message');

        Log::info('Invoking EmailController.................1');
        Log::info('Invoking EmailController.................2='.$name);
        Log::info('Invoking EmailController.................3='.$email);
        Log::info('Invoking EmailController.................4='.$phone);
        Log::info('Invoking EmailController.................5='.$message);


        Mail::to('agencybucket17@gmail.com')->send(new EmailContactus());
        return view('front-contact')->with(["STATUS" => "SUCCESS"]);
    }
}
