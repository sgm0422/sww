<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_requires_authentication(): void
    {
        $this->get('/z')->assertRedirect('/z/login');
    }

    public function test_authenticated_user_can_open_article_management(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/z/articles')
            ->assertOk();
    }

    public function test_authenticated_user_can_open_article_create_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/z/articles/create')
            ->assertOk();
    }
}
