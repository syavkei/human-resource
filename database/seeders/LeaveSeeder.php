<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use factories to create dummy leave data
        \App\Models\Leave::factory()->count(10)->create();
    }
}
