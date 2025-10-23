<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'code' => strtoupper(fake()->bothify('???###')),
            'description' => fake()->paragraph(),
            'teacher_id' => Teacher::inRandomOrder()->first(),
            'department_id' => Department::inRandomOrder()->first(),
            'credits' => fake()->numberBetween(1, 5),
            'is_active' => fake()->boolean(80),
        ];
    }
}
