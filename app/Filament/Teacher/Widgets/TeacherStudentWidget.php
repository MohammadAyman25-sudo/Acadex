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
        $studentsCount = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('courses.department_id', $teacher->department_id)
            ->distinct('enrollments.student_id')
            ->count('enrollments.student_id');

        return [
            Stat::make('Total Students', $studentsCount)
                ->color('success')
                ->icon('heroicon-o-users')
                ->description('Total number of students you\'re teaching regardless to the course'),
        ];
    }
}
