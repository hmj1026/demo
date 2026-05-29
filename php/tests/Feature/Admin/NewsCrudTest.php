<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Tests\Concerns\SeedsRbac;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin;
use App\Models\News;

/**
 * Characterization tests for admin News CRUD.
 *
 * Covers the validate -> persist -> flash -> redirect cycle and the policy-gated
 * detail view. Captures current behavior (success flash class, validation
 * errors, DB writes) so the Laravel 6 request/validation changes are verified.
 */
class NewsCrudTest extends TestCase
{
    use RefreshDatabase;
    use SeedsRbac;

    private function root()
    {
        return factory(Admin::class)->state('ROOT')->create();
    }

    public function test_create_form_renders()
    {
        $this->seedRbac();

        $this->actingAs($this->root(), 'admin')
            ->get('/admin/news/create')
            ->assertSuccessful()
            ->assertViewIs('admin.news.create');
    }

    public function test_store_persists_news_and_flashes_success()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($this->root(), 'admin')
            ->post('/admin/news/create', [
                'type' => 'news',
                'title' => 'Launch Announcement',
                'sub_title' => 'Big news',
                'content' => 'Body copy here',
                'status' => 1,
            ])
            ->assertStatus(302)
            ->assertSessionHas('class', 'success');

        $this->assertDatabaseHas('news', ['title' => 'Launch Announcement']);
    }

    public function test_store_rejects_missing_required_fields()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($this->root(), 'admin')
            ->post('/admin/news/create', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['type', 'title', 'content']);
    }

    public function test_detail_page_renders_for_existing_news()
    {
        $this->seedRbac();
        $news = factory(News::class)->create();

        $this->actingAs($this->root(), 'admin')
            ->get("/admin/news/{$news->id}/detail")
            ->assertSuccessful()
            ->assertViewIs('admin.news.detail');
    }

    public function test_update_changes_news_and_flashes_success()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $news = factory(News::class)->create();

        $this->actingAs($this->root(), 'admin')
            ->patch("/admin/news/{$news->id}/detail", [
                'type' => 'article',
                'title' => 'Edited Title',
                'sub_title' => 'Edited sub',
                'content' => 'Edited body',
                'status' => 1,
            ])
            ->assertStatus(302)
            ->assertSessionHas('class', 'success');

        $this->assertDatabaseHas('news', ['id' => $news->id, 'title' => 'Edited Title']);
    }
}
