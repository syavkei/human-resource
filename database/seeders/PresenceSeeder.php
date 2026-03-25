<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 25) as $employeeId) {
            foreach (range(1, 30) as $day) {
                \App\Models\Presence::create([
                    'employee_id' => $employeeId,
                    'date' => now()->subDays(30 - $day)->toDateString(),
                    'clock_in' => now()->subDays(30 - $day)->setTime(rand(7, 9), rand(0, 59))->toTimeString(),
                    'clock_out' => now()->subDays(30 - $day)->setTime(rand(16, 18), rand(0, 59))->toTimeString(),
                    'status' => ['Present', 'Absent', 'Late'][array_rand(['Present', 'Absent', 'Late'])],
                ]);
            }
        }
    }
}
