<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseSession>
 */
class CourseSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course = Course::inRandomOrder()->first();
        $teacher = $course->teachers()->inRandomOrder()->first();
        return [
            'course_id' => $course,
            'teacher_id' => $teacher,
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'date' => $this->faker->date(),
            'topic' => $this->faker->sentence(),
        ];
    }
}
