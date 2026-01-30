<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Enrollment;
use App\Models\CourseTeacher;
use Filament\Widgets\ChartWidget;

class EnrollmentWidget extends ChartWidget
{
    protected ?string $heading = 'Enrollment Widget';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $courses = CourseTeacher::query()->where('teacher_id', auth()->user()->teacher->id)?->pluck('course_id')->toArray();
        $counts = Enrollment::query()->selectRaw('status, COUNT(*) as total')
            ->whereIn('enrollments.course_id', $courses)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        return [
            'datasets' => [
                [
                    'label' => 'Enrollments',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        '#3b82f6',
                        '#22c55e',
                        '#ef4444',
                        '#eab308',
                        '#983d6e',
                    ]
                ]
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
