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
                    ->whereHas('courseSession', function ($q) {
                        $q->whereDate('date','=', today());
                    })
                    ->selectRaw('status, COUNT(*) as count')
                    ->groupBy('status')
                    ->pluck('count', 'status')
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
