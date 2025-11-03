<?php

namespace App\Filament\Widgets;

use App\Models\Enrollment;
use Filament\Widgets\ChartWidget;

class EnrollmentChart extends ChartWidget
{
    protected ?string $heading = 'Enrollment Chart';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $counts = Enrollment::query()->selectRaw('status, COUNT(*) as total')
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
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
