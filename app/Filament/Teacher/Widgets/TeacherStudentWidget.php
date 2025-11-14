<?php

namespace App\Filament\Teacher\Widgets;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TeacherStudentWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $teacher = auth()->user()->teacher;
        $coursesCount = $teacher->courses()->count();
        $coursesIds = DB::table('course_teacher')
            ->where('course_teacher.teacher_id', $teacher->id)
            ->distinct('course_teacher.course_id')
            ->pluck('course_teacher.course_id')
            ->toArray();
        $studentsCount = DB::table('enrollments')   
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->whereIn('enrollments.course_id', $coursesIds)
            ->where('courses.department_id', $teacher->department_id)
            ->whereIn('enrollments.status', ['enrolled',  'completed', 'failed'])
            ->distinct('enrollments.student_id')
            ->count('enrollments.student_id');

        return [
            Stat::make('Total Students', $studentsCount)
                ->color('success')
                ->icon('heroicon-o-users')
                ->description('Total number of students you\'re teaching regardless to the course'),
            Stat::make('Total Courses', $coursesCount)
                ->color('primary')
                ->icon('heroicon-o-book-open')
                ->description('Total number of courses you are teaching')
        ];
    }
}
