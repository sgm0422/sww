<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\PageVisit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_are_recorded_in_page_visits(): void
    {
        $this->get('/')->assertOk();
        $this->get('/about')->assertOk();

        $this->assertSame(2, PageVisit::count());
        $this->assertDatabaseHas('page_visits', ['path' => '/']);
        $this->assertDatabaseHas('page_visits', ['path' => '/about']);
    }

    public function test_opening_article_detail_increments_and_displays_reading_count(): void
    {
        $article = Article::factory()->published()->create();

        $this->get(route('articles.show', $article->slug))
            ->assertOk()
            ->assertSee('阅读 1');

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'views_count' => 1,
        ]);

        $this->get(route('articles.show', $article->slug))
            ->assertOk()
            ->assertSee('阅读 2');
    }

    public function test_article_cards_and_admin_list_show_reading_count(): void
    {
        $article = Article::factory()->published()->create([
            'views_count' => 12,
        ]);

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee('阅读 12');

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('阅读 12');

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/z/articles')
            ->assertOk()
            ->assertSee('阅读数')
            ->assertSee('12');
    }
}
