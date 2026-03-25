<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use factories to create dummy task data
        \App\Models\Task::factory()->count(50)->create();
    }
}
