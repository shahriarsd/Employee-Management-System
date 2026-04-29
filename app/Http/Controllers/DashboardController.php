<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'stats' => [
                'total_employees'   => Employee::count(),
                'on_leave_today'    => Leave::where('status', 'approved')
                    ->whereDate('from_date', '<=', today())
                    ->whereDate('to_date', '>=', today())
                    ->count(),
                'total_departments' => Department::count(),
                'pending_approvals' => Leave::where('status', 'pending')->count(),
            ],
        ]);
    }
}
