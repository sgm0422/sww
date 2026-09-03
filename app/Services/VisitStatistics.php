<?php

namespace App\Services;

use App\Models\Article;
use App\Models\PageVisit;

class VisitStatistics
{
    public function todayVisits(): int
    {
        return PageVisit::query()
            ->whereDate('visited_at', today())
            ->count();
    }

    public function totalVisits(): int
    {
        return PageVisit::count();
    }

    public function totalArticleViews(): int
    {
        return Article::sum('views_count');
    }

    public function totalArticles(): int
    {
        return Article::count();
    }

    public function dailyVisits(int $days = 30): array
    {
        $start = today()->subDays($days - 1)->startOfDay();

        $rows = PageVisit::query()
            ->where('visited_at', '>=', $start)
            ->selectRaw('DATE(visited_at) AS day, COUNT(*) AS total')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $labels = [];
        $data = [];

        for ($index = 0; $index < $days; $index++) {
            $date = $start->copy()->addDays($index);
            $labels[] = $date->format('m-d');
            $data[] = (int) ($rows[$date->toDateString()] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
