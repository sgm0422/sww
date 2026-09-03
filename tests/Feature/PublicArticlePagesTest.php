<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicArticlePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_published_articles_but_not_drafts(): void
    {
        $published = Article::factory()->published()->create();
        $draft = Article::factory()->create();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($draft->title);
    }

    public function test_article_index_only_lists_published_articles(): void
    {
        $published = Article::factory()->published()->create();
        $draft = Article::factory()->create();

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($draft->title);
    }

    public function test_published_article_detail_is_accessible(): void
    {
        $article = Article::factory()->published()->create();

        $this->get(route('articles.show', $article->slug))
            ->assertOk()
            ->assertSee($article->title);
    }

    public function test_draft_article_detail_returns_not_found(): void
    {
        $draft = Article::factory()->create();

        $this->get(route('articles.show', $draft->slug))->assertNotFound();
    }
}
