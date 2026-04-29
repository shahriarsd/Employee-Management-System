<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeaveController extends Controller
{
    public function index()
    {
        return Inertia::render('Leaves/Index', [
            'leaves' => Leave::with('employee')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Leaves/Form', [
            'employees' => Employee::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'reason'      => 'required|string',
        ]);

        Leave::create($request->all());
        return redirect()->route('leaves.index')->with('success', 'Leave applied.');
    }

    public function updateStatus(Request $request, Leave $leave)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $leave->update(['status' => $request->status]);
        return redirect()->route('leaves.index')->with('success', 'Leave status updated.');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave deleted.');
    }
}
