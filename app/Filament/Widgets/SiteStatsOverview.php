<?php

namespace App\Filament\Widgets;

use App\Services\VisitStatistics;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SiteStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = app(VisitStatistics::class);

        return [
            Stat::make('今日访问', $stats->todayVisits())
                ->description('当天前台页面访问次数')
                ->icon('heroicon-m-eye'),
            Stat::make('累计访问', $stats->totalVisits())
                ->description('前台页面累计访问次数')
                ->icon('heroicon-m-chart-bar'),
            Stat::make('文章阅读数', $stats->totalArticleViews())
                ->description('全部文章详情页累计阅读数')
                ->icon('heroicon-m-document-text'),
            Stat::make('文章总数', $stats->totalArticles())
                ->description('已创建的全部文章')
                ->icon('heroicon-m-document-duplicate'),
        ];
    }
}
