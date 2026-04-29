<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayrollController extends Controller
{
    public function index()
    {
        return Inertia::render('Payrolls/Index', [
            'payrolls' => Payroll::with('employee')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Payrolls/Form', [
            'employees' => Employee::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'   => 'required|exists:employees,id',
            'basic_salary'  => 'required|numeric|min:0',
            'bonus'         => 'nullable|numeric|min:0',
            'deduction'     => 'nullable|numeric|min:0',
            'month'         => 'required|string',
        ]);

        Payroll::create($request->all());
        return redirect()->route('payrolls.index')->with('success', 'Payroll created.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted.');
    }
}
