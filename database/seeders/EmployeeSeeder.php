<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use factories to create dummy employee data
        \App\Models\Employee::factory()->count(25)->create();
    }
}
