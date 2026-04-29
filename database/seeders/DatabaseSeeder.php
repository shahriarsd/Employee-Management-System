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
        User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password')]);

        $departments = ['Engineering', 'Marketing', 'HR', 'Finance'];
        foreach ($departments as $dept) {
            Department::create(['name' => $dept]);
        }

        $employees = [
            ['name' => 'John Smith',  'email' => 'john@example.com',  'phone' => '01711000001', 'department_id' => 1, 'role' => 'Software Engineer', 'salary' => 5000],
            ['name' => 'Sara Ahmed',  'email' => 'sara@example.com',  'phone' => '01711000002', 'department_id' => 2, 'role' => 'Marketing Lead',    'salary' => 4500],
            ['name' => 'Rahim Khan',  'email' => 'rahim@example.com', 'phone' => '01711000003', 'department_id' => 3, 'role' => 'HR Manager',        'salary' => 4000],
        ];
        foreach ($employees as $emp) {
            Employee::create($emp);
        }
    }
}
