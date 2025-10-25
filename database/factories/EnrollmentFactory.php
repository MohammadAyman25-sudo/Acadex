<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement([
            ...array_fill(0, 40, 'enrolled'),
            ...array_fill(0, 25, 'in_progress'),
            ...array_fill(0, 20, 'completed'),
            ...array_fill(0, 10, 'failed'),
            ...array_fill(0, 5, 'withdrawn'),
        ]);

        $grade = match($status) {
            'completed' => round(fake()->randomFloat(2, 60, 100), 2),
            'failed' => round(fake()->randomFloat(2, 0, 59.99), 2),
            default => null,
        };

        return [
            'student_id' => Student::inRandomOrder()->first(),
            'course_id' => Course::inRandomOrder()->first(),
            'grade' => $grade,
            'status' => $status,
        ];
    }
}
