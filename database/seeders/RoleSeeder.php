<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Staff', 'description' => 'General employee with access to basic HRIS features.'],
            ['name' => 'Supervisor', 'description' => 'Manages a team of employees and has access to performance reviews.'],
            ['name' => 'Manager', 'description' => 'Oversees teams and has access to performance reviews and team management.'],
            ['name' => 'HR', 'description' => 'Manages employee records, recruitment, and HR policies.'],
            ['name' => 'Admin', 'description' => 'Full access to all HRIS features and settings.'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
