<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TenantNotificationSettingRepository;

class TenantNotificationSettingController extends Controller
{
    protected $repository;

    public function __construct(TenantNotificationSettingRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $input = $request->all();
   
        if ($this->repository->create($input))
            return redirect()->back()->with('success', 'Notification setting has been saved.');
        else
            return redirect()->back()->with('error', 'Failed to save notification setting.');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        if ($this->repository->update($input, $id))
            return redirect()->back()->with('success', 'Notification setting has been updated.');
        else
            return redirect()->back()->with('error', 'Failed to update notification setting.');
    }
}
