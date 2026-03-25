<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'HR', 'description' => 'Handles recruitment, employee relations, and benefits.', 'status' => 'active'],
            ['name' => 'Finance', 'description' => 'Manages company finances, budgeting, and payroll.', 'status' => 'active'],
            ['name' => 'IT', 'description' => 'Responsible for technology infrastructure and support.', 'status' => 'active'],
            ['name' => 'Marketing', 'description' => 'Focuses on advertising, promotions, and market research.', 'status' => 'active'],
            ['name' => 'Sales', 'description' => 'Drives revenue through customer acquisition and retention.', 'status' => 'active'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
