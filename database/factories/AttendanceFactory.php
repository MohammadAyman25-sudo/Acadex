<?php

namespace Database\Factories;

use App\Models\CourseSession;
use Illuminate\Support\Facades\Log;
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
        $session = CourseSession::whereHas('course.students', function ($query) {
            $query->whereIn('enrollments.status', ['enrolled', 'failed', 'completed', 'withdrawn']);
        })
            ->inRandomOrder()
            ->with('course.students')
            ->first();
        if (!$session) {
            return [
                'session_id' => null,
                'student_id' => null,
                'status' => 'absent',
                'note' => null,
            ];
        }
        $student = $session
            ->course
            ->students()
            ->whereIn('enrollments.status', ['enrolled', 'failed', 'completed', 'withdrawn'])
            ->inRandomOrder()
            ->first();
        if (!$student) {
            return [
                'session_id' => $session->id,
                'student_id' => null,
                'status' => 'absent',
                'note' => null,
            ];
        }
        return [
            'session_id' => $session?->id,
            'student_id' => $student?->id,
            'status' => $this->faker->randomElement(['present', 'absent', 'excused', 'late']),
            'note' => $this->faker->optional()->sentence(),
        ];
    }
}
