<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(LeaveSeeder::class);
        $this->call(PresenceSeeder::class);
        $this->call(PayrollSeeder::class);
    }
}
