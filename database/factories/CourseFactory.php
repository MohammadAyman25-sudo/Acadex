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
            'department_id' => Department::inRandomOrder()->first(),
            'credits' => fake()->numberBetween(1, 5),
            'is_active' => fake()->boolean(80),
        ];
    }

    public function configure() {
        return $this->afterCreating(function ($course) {
            $teachers = Teacher::inRandomOrder()->take(rand(1, 3))->get();
            $course->teachers()->attach($teachers, [
                'role' => fake()->randomElement(['Instructor', 'Assistant']),
                'semester' => fake()->randomElement(['Fall', 'Spring', 'Summer']),
            ]);
        });
    }
}
