<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemOverviewStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('The total number of students in the system')
                ->descriptionColor('success'),
            Stat::make('Total Teachers', Teacher::count())
                ->description('The total number of teachers in the system')
                ->descriptionColor('primary'),
            Stat::make('Total Courses', Course::count())
                ->description('The total number of courses in the system')
                ->descriptionColor('danger'),
            Stat::make('Total Departments', Department::count())
                ->description('The count of departments in the system')
                ->descriptionColor('info'),
        ];
    }
}
