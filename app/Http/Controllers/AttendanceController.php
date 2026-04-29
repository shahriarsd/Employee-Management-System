<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $date = $request->get('date', today()->toDateString());

        if ($user->isAdmin()) {
            $employees = Employee::with(['attendances' => fn($q) => $q->whereDate('date', $date)])
                ->get()
                ->map(fn($e) => [
                    'id'         => $e->id,
                    'name'       => $e->name,
                    'attendance' => $e->attendances->first(),
                ]);
        } elseif ($user->employee_id) {
            $employee = Employee::with(['attendances' => fn($q) => $q->whereDate('date', $date)])
                ->findOrFail($user->employee_id);
            $employees = [[
                'id'         => $employee->id,
                'name'       => $employee->name,
                'attendance' => $employee->attendances->first(),
            ]];
        } else {
            $employees = [];
        }

        return Inertia::render('Attendances/Index', [
            'employees' => $employees,
            'date'      => $date,
            'isAdmin'   => $user->isAdmin(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'date'                  => 'required|date',
            'records'               => 'required|array',
            'records.*.employee_id' => 'required|exists:employees,id',
            'records.*.status'      => 'required|in:present,absent,late',
            'records.*.note'        => 'nullable|string',
        ]);

        // Non-admin can only submit their own attendance
        if (! $user->isAdmin()) {
            foreach ($data['records'] as $record) {
                abort_unless((int) $record['employee_id'] === (int) $user->employee_id, 403);
            }
        }

        foreach ($data['records'] as $record) {
            Attendance::updateOrCreate(
                ['employee_id' => $record['employee_id'], 'date' => $data['date']],
                ['status' => $record['status'], 'note' => $record['note'] ?? null]
            );
        }

        return back()->with('success', 'Attendance saved.');
    }
}
