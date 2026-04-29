<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    // Admin: list all users and their linked employee
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users'     => User::with('employee')->get(),
            'employees' => Employee::all(),
        ]);
    }

    // Admin: link a user to an employee and set role
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role'        => 'required|in:admin,employee',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $user->update($request->only('role', 'employee_id'));
        return back()->with('success', 'User updated.');
    }
}
