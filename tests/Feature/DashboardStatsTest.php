<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\PageVisit;
use App\Models\User;
use App\Services\VisitStatistics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_statistics_aggregate_page_visits_and_article_views(): void
    {
        PageVisit::create([
            'path' => '/',
            'ip_address' => '127.0.0.1',
            'visited_at' => now(),
        ]);
        PageVisit::create([
            'path' => '/about',
            'ip_address' => '127.0.0.1',
            'visited_at' => now(),
        ]);
        PageVisit::create([
            'path' => '/articles/old-post',
            'ip_address' => '127.0.0.1',
            'visited_at' => now()->subDay(),
        ]);

        Article::factory()->published()->create(['views_count' => 7]);
        Article::factory()->create();

        $stats = app(VisitStatistics::class);

        $this->assertSame(2, $stats->todayVisits());
        $this->assertSame(3, $stats->totalVisits());
        $this->assertSame(7, $stats->totalArticleViews());
        $this->assertSame(2, $stats->totalArticles());
    }

    public function test_dashboard_renders_site_visit_statistics_widgets(): void
    {
        PageVisit::create([
            'path' => '/',
            'ip_address' => '127.0.0.1',
            'visited_at' => now(),
        ]);
        Article::factory()->published()->create(['views_count' => 5]);

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/z')
            ->assertOk()
            ->assertSee('今日访问')
            ->assertSee('累计访问')
            ->assertSee('文章阅读数')
            ->assertSee('文章总数')
            ->assertSee('最近 30 天访问趋势');
    }

    public function test_visit_statistics_builds_a_thirty_day_series(): void
    {
        PageVisit::create([
            'path' => '/',
            'ip_address' => '127.0.0.1',
            'visited_at' => now(),
        ]);
        PageVisit::create([
            'path' => '/articles/old-post',
            'ip_address' => '127.0.0.1',
            'visited_at' => now()->subDays(29),
        ]);

        $series = app(VisitStatistics::class)->dailyVisits(30);

        $this->assertCount(30, $series['labels']);
        $this->assertCount(30, $series['data']);
        $this->assertSame(now()->format('m-d'), $series['labels'][29]);
        $this->assertSame(1, $series['data'][29]);
        $this->assertSame(1, $series['data'][0]);
    }
}
