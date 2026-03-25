<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'department_id' => rand(1, 5),
            'role_id' => rand(1, 3),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'hire_date' => fake()->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement(['active', 'inactive', 'on_leave']),
            'salary' => fake()->numberBetween(30000, 150000),
        ];
    }
}
