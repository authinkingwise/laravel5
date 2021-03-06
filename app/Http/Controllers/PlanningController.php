<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PlanningRepository;

class PlanningController extends Controller
{
    protected $repository;

    protected $tenant_id;

    public function __construct(PlanningRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function store(Request $request)
    {
    	$input = $request->all();
    	$input['creator_id'] = Auth::id();
    	$input['tenant_id'] = Auth::user()->tenant_id;

    	if ($this->repository->create($input)) {
    		return redirect()->back()->with('success', 'This planning has been saved.');
    	} else {
    		return redirect()->back()->with('error', 'Failed to save the planning.');
    	}
    }

    public function update(Request $request, $id)
    {
    	$input = $request->all();

        if ($this->repository->update($input, $id)) {
            return redirect()->back()->with('success', 'This planning has been updated.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the planning.');
        }
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        $planning = $this->repository->find($id);

        if ($planning->actual_hours > 0 && empty($planning->schedule_hours)) {
            if ($planning->delete())
                return redirect()->back()->with('success', 'The actual hours of planning has been updated.');
        }

        if ($planning->actual_hours > 0 && $planning->schedule_hours > 0) {
            $planning->actual_hours = null;
            $planning->actual_date = null;
            if ($planning->save())
                return redirect()->back()->with('success', 'This planning has been updated.');
        }
    }

    public function getByTicketId($ticket_id)
    {

    }
}
