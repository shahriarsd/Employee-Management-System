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
        $user = auth()->user();

        if ($user->isAdmin()) {
            $leaves = Leave::with('employee')->latest()->get();
        } elseif ($user->employee_id) {
            $leaves = Leave::with('employee')
                ->where('employee_id', $user->employee_id)
                ->latest()->get();
        } else {
            $leaves = collect();
        }

        return Inertia::render('Leaves/Index', [
            'leaves'  => $leaves,
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        return Inertia::render('Leaves/Form', [
            'employees' => $user->isAdmin() ? Employee::all() : [],
            'isAdmin'   => $user->isAdmin(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $request->validate(['employee_id' => 'required|exists:employees,id']);
            $employeeId = $request->employee_id;
        } else {
            if (! $user->employee_id) {
                return back()->withErrors(['employee_id' => 'Your account is not linked to an employee profile. Please contact admin.']);
            }
            $employeeId = $user->employee_id;
        }

        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
            'reason'    => 'required|string',
        ]);

        Leave::create([
            'employee_id' => $employeeId,
            'from_date'   => $request->from_date,
            'to_date'     => $request->to_date,
            'reason'      => $request->reason,
        ]);

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
