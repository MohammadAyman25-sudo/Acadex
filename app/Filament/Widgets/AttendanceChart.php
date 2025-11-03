<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;

class AttendanceChart extends ChartWidget
{
    protected ?string $heading = 'Today\'s Attendance Chart';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $counts = Attendance::query()
                    ->selectRaw("status, COUNT(*) as total")
                    ->whereHas('courseSession', function ($q):void {
                        $q->whereDate('course_sessions.date', '=', today());
                    })
                    ->groupBy('status')
                    ->pluck('total', 'status')
                    ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Today\'s Attendance',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        '#3b82f6',
                        '#22c55e',
                        '#ef4444',
                        '#eab308',
                        '#983d6e',
                    ],
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
