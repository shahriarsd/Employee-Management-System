<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        return Inertia::render('Departments/Index', [
            'departments' => Department::withCount('employees')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:departments', 'description' => 'nullable|string']);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate(['name' => 'required|string|unique:departments,name,' . $department->id, 'description' => 'nullable|string']);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted.');
    }
}
