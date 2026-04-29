<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        // Sample department
        $dept = Department::firstOrCreate(['name' => 'Engineering'], ['description' => 'Tech team']);

        // Sample employee
        $employee = Employee::firstOrCreate(
            ['email' => 'employee@example.com'],
            ['name' => 'John Doe', 'phone' => '01700000000', 'department_id' => $dept->id, 'role' => 'Developer', 'salary' => 50000]
        );

        // Employee user linked to employee record
        User::updateOrCreate(
            ['email' => 'employee@example.com'],
            ['name' => 'John Doe', 'password' => Hash::make('password'), 'role' => 'employee', 'employee_id' => $employee->id]
        );
    }
}
