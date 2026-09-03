<?php

namespace App\Filament\Widgets;

use App\Services\VisitStatistics;
use Filament\Widgets\ChartWidget;

class SiteVisitsChart extends ChartWidget
{
    protected static ?string $heading = '最近 30 天访问趋势';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $series = app(VisitStatistics::class)->dailyVisits(30);

        return [
            'datasets' => [
                [
                    'label' => '访问量',
                    'data' => $series['data'],
                ],
            ],
            'labels' => $series['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
