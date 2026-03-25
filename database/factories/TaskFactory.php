<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // name
        // description
        // assigned_to
        // due_date
        // status
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'assigned_to' => rand(1, 25), // Assuming you have 25 employees
            'due_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
        ];
    }
}
