<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use factories to create dummy payroll data
        \App\Models\Payroll::factory()->count(25)->create();
    }
}
