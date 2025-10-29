<?php

namespace Database\Factories;

use App\Models\CourseSession;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => CourseSession::inRandomOrder()->first(),
            'student_id' => Student::inRandomOrder()->first(),
            'status' => $this->faker->randomElement(['present', 'absent', 'excused', 'late']),
            'note' => $this->faker->optional()->sentence(),
        ];
    }
}
