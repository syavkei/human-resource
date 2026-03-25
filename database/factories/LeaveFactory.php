<?php

namespace Database\Factories;

use App\Models\Leave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // employee_id
        // start_date
        // end_date
        // type
        // reason
        // status
        return [
            'employee_id' => rand(1, 25),
            'start_date' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('+1 day', '+1 year')->format('Y-m-d'),
            'type' => fake()->randomElement(['sick_leave', 'vacation_leave', 'maternity_leave', 'paternity_leave']),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
